<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\Calendar;
use App\Models\ClassRegister;
use App\Models\ClassSchool;
use App\Models\ClassUser;
use App\Models\Contract;
use App\Models\District;
use App\Models\Province;
use App\Models\Subject;
use App\Models\Ward;
use App\Http\Services\TutorService;
use App\Jobs\SendMailAssignClassRegister;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use stdClass;

class ClassRegisterController extends Controller
{
    use ResponseTrait;

    public function __construct()
    {
        $this->middleware('can:admin.classes-register.index')->only('index');
        $this->middleware('can:admin.classes-register.store')->only(['create','store']);
        $this->middleware('can:admin.classes-register.update')->only(['edit', 'update']);
        $this->middleware('can:admin.classes-register.destroy')->only('destroy');
        $this->middleware('can:admin.api.classes-register.calendar')->only(['addCalendar', 'deleteCalendar']);
        $this->middleware('can:admin.api.classes-register.assign')->only('assignClass');
        $this->middleware('can:admin.api.classes-register.filter')->only('filterTutor');
        $this->middleware('can:admin.api.classes-register.userAssigned')->only('getUserAssignee');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::where("status",ACTIVE)->get();
        return view("backend.classesRegister.index", compact("contracts"));
    }
    public function getData()
    {
        $classesRegister = ClassRegister::with("class", "subject")->get();
        $data["data"] = $classesRegister;
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = ClassSchool::all();
        $subjects = Subject::where("status",ACTIVE)->get();
        $provinces = Province::all();
        return view("backend.classesRegister.create", compact("classes", "subjects", "provinces"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = (object) $request->all();
            $data->price_class = str_replace(',', '', $data->price_class);
            $nameClass = ClassSchool::find($data->class_id)->name_class;
            $nameSubject = Subject::find($data->subject_id)->name;
            $data->keyword = $nameSubject." ". $nameClass;
            $data->code_class = "VNA_".mt_rand(1000000, 9999999);
            ClassRegister::create((array) $data);
            $message = $this->response("success", "Đăng ký lớp thành công");
            return redirect()->route("admin.classes-register.index")->with($message);
        } catch (\Throwable $th) {
            info("log:".$th);
            $message = $this->response("error", "Có lỗi xảy ra, vui lòng thử lại");
            return back()->with($message);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassRegister  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classRegister = ClassRegister::findOrFail($id);
        $classes = ClassSchool::all();
        $subjects = Subject::where("status",ACTIVE)->get();
        $provinces = Province::all();
        $districts = District::where("matp", $classRegister->province_id)->get();
        $wards = Ward::where("maqh", $classRegister->ward_id)->get();
        return view("backend.classesRegister.edit", compact("classRegister", "classes", "subjects", "provinces", "districts", "wards"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            $classesRegister = ClassRegister::find($id);
            $nameClass = ClassSchool::find($request->class_id)->name_class;
            $nameSubject = Subject::find($request->subject_id)->name;
            $classesRegister->update([
                'scope_class' => $request->scope_class,
                'province_id' => $request->province_id,
                'district_id' => $request->district_id,
                'ward_id' => $request->ward_id,
                'price_class' => str_replace(',', '', $request->price_class),
                'fee__percentage_class' => $request->fee__percentage_class,
                'number_lesson_week' => $request->number_lesson_week,
                'request_class' => $request->request_class,
                'time_to_study' => $request->time_to_study,
                'student_note' => $request->student_note,
                'status' => $request->status,
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id,
                'gender_request' => $request->gender_request,
                'role_user' => $request->role_user,
                'is_experienced' => $request->is_experienced,
                'is_university_top' => $request->is_university_top,
                'is_calendar' => $request->is_calendar,
                'embed_map' => $request->embed_map,
                "keyword" => $nameSubject." ". $nameClass
            ]);
            // Check assign
            if(in_array($request->status, [ASSIGN_CANCEL, ASSIGN_PENDING])) {
                ClassUser::where("class_id", $id)->update(['is_email' => INACTIVE, 'status'=>0]);
            }
            $message = $this->response("success", "Cập nhật lớp đăng ký thành công");
            return redirect()->route("admin.classes-register.index")->with($message);
        } catch (\Throwable $th) {
            info("log:".$th);
            $message = $this->response("error", "Có lỗi xảy ra, vui lòng thử lại");
            return back()->with($message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $classRegister = ClassRegister::find($id);
            $classRegister->delete();
            $message = $this->response("success", "Xóa lớp đăng ký thành công");
            return redirect()->route("admin.classes-register.index")->with($message);
        } catch (\Throwable $th) {
            info("log:".$th);
            $message = $this->response("error", "Có lỗi xảy ra, vui lòng thử lại");
            return back()->with($message);
        }
    }
    public function addCalendar(Request $request, $classRegisterId) {
       try {
        $calendar = new Calendar();
        $calendarExist = Calendar::find($request->calendar_id);
        if($calendarExist) $calendar = $calendarExist;
        $calendar->class_register_id = $classRegisterId;
        $calendar->day = $request->day_class_register;
        $calendar->start_time = $request->start_time;
        $calendar->end_time = $request->end_time;
        $calendar->date = $request->date_class;
        $calendar->save();
        return new JsonResponse([
            'success' => true,
            'data'=>$calendar,
            'message' => 'Cập nhật lịch thành công cho lớp học',
        ], 200);
       } catch (\Throwable $th) {
        return new JsonResponse([
            'success' => false,
            'message' => 'Có lỗi xảy ra vui lòng thử lại',
        ], 500);
       }
    }
    public function deleteCalendar(Request $request, $calendarId) {
        try {
            $calendar = Calendar::find($calendarId);
            $calendar->delete();
            return new JsonResponse([
                'success' => true,
                'message' => 'Xóa lịch thành công',
            ], 200);
           } catch (\Throwable $th) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Có lỗi xảy ra vui lòng thử lại',
            ], 500);
           }
    }
    public function assignClass(Request $request, $idClass, $userId) {
        try {
            $class = ClassRegister::where("id", $idClass)->with(['subject', 'class'])->first();
            $user = User::find($userId);
            $now = Carbon::now();
            $class->status = ASSIGN_ACTED;
            $class->save();
            // Kiểm tra check nếu đã thực hiện assign user này r sễ thông báo lỗi
            $hasAssign = $class->users()->wherePivot( "user_id",$userId)->wherePivot("status",ACTIVE)->wherePivot("contract_id",$request->contract_id)->exists();
            if($hasAssign)  {
                return new JsonResponse([
                    'success' => false,
                    'message' => 'Gia sư đã được giao lớp trước đó',
                ], 500);
            }
            // Thực hiện cập nhật tất cả trạng thái lớp giao cho gia sư về 0:is_email,status
            ClassUser::where("class_id", $idClass)->update(['is_email' => INACTIVE, 'status'=>0]);
            // Thực hiện cập nhật hoặc thêm bản ghi mới
            $updateResult = $class->users()->updateExistingPivot($userId,["status" => ACTIVE,'is_email'=>ACTIVE,"contract_id" => $request->contract_id,"created_at" => $now,"updated_at" => $now]);
            if($updateResult == 0) $class->users()->attach($userId,["status" =>  ACTIVE,'is_email'=>ACTIVE,"contract_id" => $request->contract_id,"created_at" => $now,"updated_at" => $now]);
            /* Thực hiện job gửi mail */
            $dispatch = new stdClass();
            $dispatch->user = $user;
            $dispatch->class = $class;
            SendMailAssignClassRegister::dispatch($dispatch);
            /* end job gửi mail */
            return new JsonResponse([
                'success' => true,
                'message' => 'Thực hiện giao lớp thành công',
            ], 201);
        } catch (\Throwable $th) {
           info($th);
           return new JsonResponse([
            'success' => false,
            'message' => 'Có lỗi xảy ra trong quá trình giao lớp',
        ], 500);
        }
    }
    public function getUserAssignee(Request $request, $idClass) {
        try {
            $class = ClassRegister::find($idClass);
            $userAssigned = $class->users()->with(["image","school"])->get();
            return $userAssigned;
        } catch (\Throwable $th) {
            info($th);
        }
    }
    public function filterTutor(Request $request, $idClassRegister) {
        $classRegister = ClassRegister::where("id",$idClassRegister)->first();
        $tutorService = new TutorService($classRegister);
        $resultFilter = $tutorService->getTutors();
        return $resultFilter;
    }
}

