<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::withCount('admins')->get();
        $permissions = Permissions::where([["level",1],["parent_id",0]])
            ->with("childPermission")
            ->get();
        return view("backend.roles.index", compact("roles", "permissions"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
        ]);
        if ($validator->fails()) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        DB::beginTransaction();
        try {
            $role = Roles::create([
                'name'=>$request->name,
                'description'=>$request->description,
            ]);
            if($request->roles) $role->permissions()->sync($request->roles);
            DB::commit();
            return new JsonResponse([
                'success' => true,
                'message' => 'Thêm vai trò thành công',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            info("log:".$th);
            return new JsonResponse([
                'success' => false,
                'message' => 'Đã có lỗi xảy ra trong quá trình cập nhật quyền',
            ], 500);
        }
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($roleId)
    {
        try {
            $role = Roles::where("id",$roleId)->with("permissions:id")->first();
            return $role;
        } catch (\Throwable $th) {
            info("Log:".$th);
            return false;
        }
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
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
        ]);
        if ($validator->fails()) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        DB::beginTransaction();
        try {
            $role = Roles::find($id);
            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();
            if($request->roles) {
                $role->permissions()->sync($request->roles);
            } else $role->permissions()->detach();
            DB::commit();
            return new JsonResponse([
                'success' => true,
                'message' => 'Cập nhật vai trò thành công',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            info("log:".$th);
            return new JsonResponse([
                'success' => false,
                'message' => 'Đã có lỗi xảy ra trong quá trình cập nhật quyền',
            ], 500);
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
        DB::beginTransaction();
        try {
            $role = Roles::find($id);
            $role->permissions()->detach();
            $role->admins()->detach();
            $role->delete();
            DB::commit();
            return new JsonResponse([
                'success' => true,
                'message' => 'Xóa vai trò thành công',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            info("LOG DELETE ROLE:".$th);
            return new JsonResponse([
                'success' => false,
                'message' => 'Đã có lỗi xảy ra trong quá trình cập nhật quyền',
            ], 500);
        }
    }
}
