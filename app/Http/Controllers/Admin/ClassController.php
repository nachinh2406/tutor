<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use App\Models\ClassSchool;
use App\Models\Subject;
use App\Models\SubjectCategory;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class ClassController extends Controller
{

    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('can:admin.classes.index')->only('index');
        $this->middleware('can:admin.classes.store')->only(['create','store']);
        $this->middleware('can:admin.classes.update')->only(['edit', 'update']);
        $this->middleware('can:admin.classes.destroy')->only('destroy');
    }
    public function index()
    {
        $classes = ClassSchool::select("id", "name_class", "level_class as level_class_custom")->get();
        return view("backend.classes.index", compact("classes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.classes.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ClassSchool::create($request->all());
        $message = $this->response("success", "Thêm lớp học thành công");
        return redirect()->route("admin.classes.index")->with($message);
        try {
            ClassSchool::create($request->all());
            $message = $this->response("success", "Thêm lớp học thành công");
            return redirect()->route("admin.classes.index")->with($message);
        } catch (\Throwable $th) {
            info("log:".$th);
            $message = $this->response("error", "Có lỗi xảy ra, vui lòng thử lại");
            return back()->with($message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassSchool $class)
    {
        return view("backend.classes.edit", compact("class"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassSchool $class)
    {
        try {
            $class->update([
                'name_class' => $request->name_class,
                'level_class' => $request->level_class,
            ]);
            $message = $this->response("success", "Cập nhật lớp học thành công");
            return redirect()->route("admin.classes.index")->with($message);
        } catch (\Throwable $th) {
            info("log:".$th);
            $message = $this->response("error", "Có lỗi xảy ra, vui lòng thử lại");
            return back()->with($message);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassSchool $class)
    {
        try {
            $class->delete();
            $message = $this->response("success", "Xóa lớp học thành công");
            return redirect()->route("admin.classes.index")->with($message);
        } catch (\Throwable $th) {
            info("log:".$th);
            $message = $this->response("error", "Có lỗi xảy ra, vui lòng thử lại");
            return back()->with($message);
        }
    }
}
