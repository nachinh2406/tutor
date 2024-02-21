<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\ClassRegister;
use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassRegisterController extends Controller
{
    use ResponseTrait;
    public function getListclasses(Request $request) {
        $params = request()->query();
        $provinceSelected = isset($params["province_id"]) ? $params["province_id"] : null;
        $districtSelected = isset($params["district_id"]) ? $params["district_id"] : null;
        $wardSelected = isset($params["ward_id"]) ? $params["ward_id"] : null;
        $levelClassSelected = isset($params["level_class"]) ? $params["level_class"] : [];
        $positionSelected = isset($params["position"]) ? $params["position"] : [];
        $searchSelected = isset($params["search"]) ? $params["search"] : null;
        $classes = ClassRegister::where("status",ASSIGN_PENDING)
        ->when(!is_null($searchSelected), function ($q) use($searchSelected) {
            return $q->where('keyword',"like","%".$searchSelected."%")->orWhere('code_class',"like","%".$searchSelected."%");
        })
        ->when(!is_null($wardSelected), function ($q) use($wardSelected) {
            return $q->where('ward_id', $wardSelected);
        })
        ->when(!is_null($districtSelected), function ($q) use($districtSelected) {
            return $q->where('district_id', $districtSelected);
        })
        ->when(!is_null($provinceSelected), function ($q) use($provinceSelected) {
            return $q->where('province_id', $provinceSelected);
        })
        ->when(count($positionSelected) > 0, function ($q) use($positionSelected) {
            return $q->whereIn('role_user', $positionSelected);
        })
        ->with(["subject","ward","district","province", "users:id,name"])
        ->withWhereHas('class', function($q) use($levelClassSelected) {
            $q->when(count($levelClassSelected) > 0, function ($q) use($levelClassSelected) {
                return $q->whereIn('level_class', $levelClassSelected);
            });
        })->paginate(10);
        $countClass = $classes->total();
        $provinces = Province::all();
        return view("frontend.classes",compact("provinces","classes","countClass","provinceSelected", "districtSelected","wardSelected", "levelClassSelected","positionSelected", "searchSelected"));
    }
    public function applyClass(Request $request, $idClass) {
        if(!auth()->check()) {
            return back()->with($this->response("error","Vui lòng thực hiện đăng nhập trước khi nhận lớp!"));
        }
       try {
        $class = ClassRegister::find($idClass);
        $userId = auth()->user()->id;
        // Thực hiện cập nhật hoặc thêm bản ghi mới
        $now = Carbon::now();
        $updateResult = $class->users()->updateExistingPivot($userId,["status" => INACTIVE,"created_at" => $now,"updated_at" => $now]);
        if($updateResult == 0) $class->users()->attach($userId,["status" => INACTIVE,'is_email'=>ACTIVE,"created_at" => $now,"updated_at" => $now]);
        return back()->with($this->response("success","Nhận lớp thành công!"));
       } catch (\Throwable $th) {
        info("Log:". $th);
        return back()->with($this->response("error","Có lỗi xảy ra trong quá trình nhận lớp!"));
       }
    }
    public function detailClass(Request $request, $idClass) {
        $classRegister = ClassRegister::where("id",$idClass)->with(["subject","ward","district","province", "users:id,name", "class"])->first();
        return view("frontend.classes_detail",compact("classRegister"));
    }
}
