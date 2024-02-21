<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UploadImageS3Service;
use App\Http\Traits\ResponseTrait;
use App\Models\Admin;
use App\Models\Roles;
use App\Rules\CheckPasswordCurrent;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AdminController extends Controller
{
    use ResponseTrait;
    protected $uploadImageService;
    protected $admin;
    public function __construct(UploadImageS3Service $uploadImageS3Service, Admin $admin)
    {
        $this->uploadImageService = $uploadImageS3Service;
        $this->admin = $admin;

            $this->middleware('can:admin.admins.index')->only('index');
            $this->middleware('can:admin.admins.store')->only(['store']);
            $this->middleware('can:admin.admins.update')->only(['update']);
            $this->middleware('can:admin.admins.destroy')->only('destroy');
    }
    public function profile() {
        $admin = auth()->guard("admin")->user();
        return view("backend.admin.profile", compact("admin"));
    }
    public function storeProfile(Request $request) {
        try {
            $admin = auth()->guard("admin")->user();
            $admin->name = $request->name;
            $admin->phone = $request->phone;
            $admin->address = $request->address;
            $admin->zip_code = $request->zip_code;
            $admin->gender = $request->gender;
            $admin->save();
            $message = $this->response("success", "Lưu thông tin cá nhân thành công");
            return back()->with($message);
        } catch (\Throwable $th) {
            info("log:".$th);
            $message = $this->response("error", "Có lỗi xảy ra, vui lòng thử lại");
            return back()->with($message);
        }
    }
    public function security() {
        return view("backend.admin.security");
    }
    public function storeAvatar(Request $request) {
        try {
            $fileUpload = $this->uploadImageService->upload($request,"admin",["png", "jpg", "jpeg","PNG","JPG","JPEG"]);
            $this->admin->saveAttactment(auth()->guard("admin")->user(), $fileUpload->getOriginalContent(), true);
            return response()->json(["message"=> "Cập nhật avatar thành công"],200);
        } catch (\Throwable $th) {
            return response()->json(["message"=> "Có lỗi xảy ra trong quá trình cập nhật avatar"],422);
        }
    }
    public function storeSecurity(Request $request) {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new CheckPasswordCurrent],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        $admin = auth()->guard("admin")->user();
        $admin->password = Hash::make($request->password);
        $admin->save();
        return new JsonResponse([
            'success' => true,
            'message' => 'Cập nhật mật khẩu thành công',
        ], 200);
    }
    public function index(Request $request) {
        $roles = Roles::all();
        return view("backend.admin.index", compact("roles"));
    }
    public function getData()
    {
        $classesRegister = Admin::with('roles')->where("is_admin","!=",ROLE_ADMIN)->get();
        $data["data"] = $classesRegister;
        return $data;
    }
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'=>['required'],
            'email'=>['required', 'unique:admins,email'],
            'password' => ['required', 'min:8','confirmed'],
        ]);
        if ($validator->fails()) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        // THÊM THÀNH VIÊN
        DB::beginTransaction();
        try {
            $admin = new Admin();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
            $admin->password = Hash::make($request->password);
            $admin->save();
            if($request->roles) $admin->roles()->sync($request->roles);
            DB::commit();
            return new JsonResponse([
                'success' => true,
                'message' => 'Thêm thành viên mới thành công',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            info("Log:".$th);
            return new JsonResponse([
                'success' => false,
                'message' => 'Có lỗi xảy ra trong quá trình thêm thành viên',
            ], 500);
        }
    }

    public function update(Request $request,$idAdmin) {
        $validator = Validator::make($request->all(), [
            'name'=>['required'],
        ]);
        if ($validator->fails()) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        // THÊM THÀNH VIÊN
        DB::beginTransaction();
        try {
            $admin = Admin::find($idAdmin);
            $admin->name = $request->name;
            $admin->phone = $request->phone;
            $admin->save();
            if($request->roles) $admin->roles()->sync($request->roles);
            DB::commit();
            return new JsonResponse([
                'success' => true,
                'message' => 'Cập nhật thành viên mới thành công',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            info("Log:".$th);
            return new JsonResponse([
                'success' => false,
                'message' => 'Có lỗi xảy ra trong quá trình cập nhật thành viên',
            ], 500);
        }
    }
    public function destroy(Admin $admin) {
        try {
            $admin->delete();
            $admin->roles()->detach();
            $message = $this->response("success", "Xóa thành viên quản trị thành công");
            return redirect()->route("admin.index")->with($message);
        } catch (\Throwable $th) {
            info("log:".$th);
            $message = $this->response("error", "Có lỗi xảy ra, vui lòng thử lại");
            return back()->with($message);
        }
    }
}
