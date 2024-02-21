<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\Calendar;
use App\Models\Card;
use App\Models\ClassRegister;
use App\Models\ClassSchool;
use App\Models\District;
use App\Models\Province;
use App\Models\School;
use App\Models\Subject;
use App\Models\Ward;
use App\Rules\CheckIfExistedPhotoCard;
use App\Rules\CheckPasswordCurrent;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ResponseTrait;
    public function profile() {
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();
        $user = auth()->user();
        return view("frontend.profile_index",compact("provinces","user","districts", "wards"));
    }
    public function detail() {
        $user = auth()->user();
        $schools = School::all();
        $classes = ClassSchool::all();
        $subjects = Subject::where("status",ACTIVE)->get();
        $classSelected = $user->class_id ? json_decode($user->class_id) : [];
        $subjectSelected = $user->subject_id ? json_decode($user->subject_id) : [];
        return view("frontend.profile_detail",compact("classes","user","subjects","schools", "classSelected", "subjectSelected"));
    }
    public function card() {
        $user = auth()->user();
        return view("frontend.profile_card",compact("user"));
    }
    public function recieveClass() {
        $user = auth()->user();
        $classesApplied = $user->classes()->with("subject","class")->wherePivot("status",INACTIVE)->get();
        return view("frontend.profile_class_recieve",compact("classesApplied"));
    }
    public function recievedClass() {
        $user = auth()->user();
        $classesApplied = $user->classes()->with("subject","class")->wherePivot("status",ACTIVE)->get();
        return view("frontend.profile_class_recieved", compact("classesApplied"));
    }
    public function changePassword(Request $request) {
        if($request->isMethod("post")) {
            $validator = Validator::make($request->all(), [
                'current_password' => ['required', new CheckPasswordCurrent("web")],
                'password' => ['required', 'min:8', 'confirmed'],
            ]);
            if ($validator->fails()) {
                return new JsonResponse([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }
            $user = auth()->user();
            $user->password = Hash::make($request->password);
            $user->save();
            return new JsonResponse([
                'success' => true,
                'message' => 'Cập nhật mật khẩu thành công',
            ], 200);
        }
        return view("frontend.profile_password");
    }
    public function updateProfile(Request $request) {
        $user = auth()->user();
        // Cập nhật trong hồ sơ của tôi
        if($request->type == "INDEX_PROFILE") {
            $user->name = !is_null($request->name) ? $request->name : null;
            $user->gender = !is_null($request->gender) ? $request->gender : null;
            $user->position = !is_null($request->position) ? $request->position : null;
            $user->note_introduce = !is_null($request->note_introduce) ? $request->note_introduce : null;
            $user->phone = !is_null($request->phone) ? $request->phone : null;
            $user->address = !is_null($request->address) ? $request->address : null;
            $user->province_id = !is_null($request->province_id) ? $request->province_id : null;
            $user->district_id = !is_null($request->district_id) ? $request->district_id : null;
            $user->ward_id = !is_null($request->ward_id) ? $request->ward_id : null;
            if($request->hasFile("verify_get_class_photo")) {
                $path = $request->file("verify_get_class_photo")->store('uploads/profile');
                $user->verify_get_class_photo = $path;
            }
            $user->save();
        } else if($request->type == "DETAIL_PROFILE") {
        // Cập nhật hồ sơ
            $user->url_facebook = !is_null($request->url_facebook) ? $request->url_facebook : null;
            $user->url_google = !is_null($request->url_google) ? $request->url_google : null;
            $user->url_linkedIn = !is_null($request->url_linkedIn) ? $request->url_linkedIn : null;
            $user->url_twitter = !is_null($request->url_twitter) ? $request->url_twitter : null;
            $user->school_id = !is_null($request->school_id) ? $request->school_id : null;
            $user->major_name = !is_null($request->major_name) ? $request->major_name : null;
            $user->start_from = !is_null($request->start_from) ? DateTime::createFromFormat('d/m/Y', $request->start_from)->format("Y-m-d") : null;
            $user->end_from = !is_null($request->end_from) ? DateTime::createFromFormat('d/m/Y', $request->end_from)->format("Y-m-d") : null;
            $user->date_of_birth = !is_null($request->date_of_birth) ? DateTime::createFromFormat('d/m/Y', $request->date_of_birth)->format("Y-m-d") : null;
            $user->is_experience = !is_null($request->is_experience) ? $request->is_experience : null;
            $user->class_id = !is_null($request->class_id) ? json_encode($request->class_id) : null;
            $user->subject_id = !is_null($request->subject_id) ? json_encode($request->subject_id) : null;
            $user->save();
        // Cập nhật chi tiết user
        } else if($request->type == "CARD_PROFILE") {
            $validated = [
                'number_card' => ['required','numeric'],
                'date_card' => ['required'],
                'expire_card' => ['required'],
                'address' => ['required'],
            ];
            $card = new Card();
            if($newCard = Card::where("user_id", $user->id)->first()) $card = $newCard;
            if(is_null($card->photo_before) && is_null($request->photo_before)) {
                $validated['photo_before'] = ['required'];
            }
            if(is_null($card->photo_after) && is_null($request->photo_after)) {
                $validated['photo_after'] = ['required'];
            }
            $request->validate($validated);
            $card->user_id = $user->id;
            $card->number_card = $request->number_card;
            $card->address = $request->address;
            $card->date_card = Carbon::parse($request->date_card)->format("Y-m-d");
            $card->expire_card = Carbon::parse($request->expire_card)->format("Y-m-d");
            if($request->hasFile("photo_before")) {
                $path = $request->file("photo_before")->store('uploads/profile');
                $card->photo_before = $path;
            }
            if($request->hasFile("photo_after")) {
                $path = $request->file("photo_after")->store('uploads/profile');
                $card->photo_after = $path;
            }
            $card->save();
        }
        // end cập nhật user

        return back()->with($this->response("success","Cập nhật thông tin thành công"));
    }
    public function calendar(Request $request) {
        return view("frontend.profile_calendar");
    }
    public function getEventsCalendar(Request $request) {
        if ($request->model == "USER") {
            $events = Calendar::where("user_id", auth()->user()->id)
            ->selectRaw("id,CONCAT(`date`,' ',`start_time`) as start, CONCAT(`date`,' ',`end_time`) as end")
            ->get();
            return response()->json(["success"=>true,"data"=>$events],200);
        }
        else {

        }
    }
    public function updateCalendar(Request $request) {
        try {
            $calendar = new Calendar();
            $calendarExist = Calendar::find($request->calendar_id);
            if($calendarExist) $calendar = $calendarExist;
            $calendar->user_id = auth()->user()->id;
            $calendar->day = $request->day_user;
            $calendar->start_time = $request->start_time;
            $calendar->end_time = $request->end_time;
            $calendar->date = $request->date_class;
            $calendar->save();
            return new JsonResponse(['success' => true,'data'=>$calendar,'message' => 'Cập nhật lịch thành công'], 200);
           } catch (\Throwable $th) {
            return new JsonResponse(['success' => false,'message' => 'Có lỗi xảy ra vui lòng thử lại'], 500);
           }
    }
    public function deleteEvent(Request $request, $idCalendar) {

        try {
            $calendar = Calendar::find($idCalendar);
            $calendar->delete();
            return new JsonResponse(['success' => true,'message' => 'Xóa lịch thành công',], 200);
           } catch (\Throwable $th) {
            return new JsonResponse(['success' => false, 'message' => 'Có lỗi xảy ra vui lòng thử lại',], 500);
           }
    }
    public function storeAvatar(Request $request) {
        try {
            $user = auth()->user();
            if($request->hasFile("file")) {
                $path = $request->file("file")->store('uploads/profile');
                $user->avatar = $path;
                $user->save();
            }
            return response()->json(["message"=> "Cập nhật avatar thành công"],200);
        } catch (\Throwable $th) {
            return response()->json(["message"=> "Có lỗi xảy ra trong quá trình cập nhật avatar"],422);
        }
    }
    public function downloadContract($idClass) {
        $pdf = Pdf::loadView('pdf.contract');
        return $pdf->download('contract.pdf');
    }
    public function comment(Request $request) {
        if($request->isMethod("post")) {
            $user = auth()->user();
            $user->comment = $request->comment;
            $user->save();
            return redirect()->route("profile.comment")->with($this->response("success","Cập nhật nội dung thành công"));
        }
        return view("frontend.profile_comment");
    }
}
