<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\Calendar;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResponseTrait;
    public function __construct(Request $request, User $user)
    {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.info')->only(['getInfoUsers']);
        $this->middleware('can:users.update.status')->only(['updateStatus']);
    }
    public function index() {
        return view("backend.user.index");
    }
    public function getData(Request $request) {
        $classesRegister = User::with("school")
        ->when(!is_null($request->id_class), function($q) use($request) {
            $q->with(['classes' => function($query) use($request) {
                $query->wherePivot('class_id',$request->id_class)
                      ->wherePivot("status",ACTIVE);
            }])->where("status",ACTIVE)
            ->with("image");
        })->get();
        $data["data"] = $classesRegister;
        return $data;
    }
    public function updateStatus(Request $request, $userId) {
        try {
            $user = User::find($userId);
            $user->status = !$user->status;
            $user->save();
            return back()->with($this->response("success", "Cập nhật trạng thái user thành công"));
        } catch (\Throwable $th) {
            info($th);
            return back()->with($this->response("error", "Có lỗi xảy ra, vui lòng thử lại"));
        }
    }
    public function getInfoUsers($userId) {
        try {
            $data = [];
            $user = User::where("id",$userId)->with("school")->first();
            $events = Calendar::where("user_id", $userId)
            ->selectRaw("id,CONCAT(`date`,' ',`start_time`) as start, CONCAT(`date`,' ',`end_time`) as end")
            ->get();
            $data['events'] = $events;
            $data['user'] = $user;
            $data['card'] = $user->card;
            $data['classedAssign'] = $user->classes()->with("class", "subject")->get();
            return new JsonResponse(['success' => true,'data' => $data,'message' => 'Lấy dữ liệu thành công'], 200);
        } catch (\Throwable $th) {
            info($th);
        }
    }
    public function updateHonnor($userId) {
        $user = User::find($userId);
        $user->is_honnor = !$user->is_honnor;
        $user->save();
        return back()->with($this->response("success", "Cập nhật trạng thái user thành công"));
    }
}
