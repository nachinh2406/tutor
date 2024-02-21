<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\SubjectCategory;
use Illuminate\Http\Request;

class SubjectCategoryController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('can:admin.subject-categories.index')->only('index');
        $this->middleware('can:admin.subject-categories.store')->only(['create','store']);
        $this->middleware('can:admin.subject-categories.update')->only(['edit', 'update']);
        $this->middleware('can:admin.subject-categories.destroy')->only('destroy');
    }
    public function index()
    {
        $subjectCategories = SubjectCategory::select("id", "name", "status as status_custom")->get();
        return view("backend.subjectCategories.index", compact("subjectCategories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.subjectCategories.create");
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
            SubjectCategory::create($request->all());
            $message = $this->response("success", "Thêm danh mục thành công");
            return redirect()->route("admin.subject-categories.index")->with($message);
        } catch (\Throwable $th) {
            info("log:".$th);
            $message = $this->response("error", "Có lỗi xảy ra, vui lòng thử lại");
            return back()->with($message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubjectCategory  $SubjectCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectCategory $SubjectCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubjectCategory  $SubjectCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubjectCategory $subjectCategory)
    {
        return view("backend.subjectCategories.edit", compact("subjectCategory"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubjectCategory  $subjectCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubjectCategory $subjectCategory)
    {
        try {
            $subjectCategory->update([
                'name' => $request->name,
                'status' => $request->status,
            ]);
            $message = $this->response("success", "Cập nhật danh mục thành công");
            return redirect()->route("admin.subject-categories.index")->with($message);
        } catch (\Throwable $th) {
            info("log:".$th);
            $message = $this->response("error", "Có lỗi xảy ra, vui lòng thử lại");
            return back()->with($message);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubjectCategory  $SubjectCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubjectCategory $SubjectCategory)
    {
        try {
            $SubjectCategory->delete();
            $message = $this->response("success", "Xóa hợp đồng thành công");
            return redirect()->route("admin.subject-categories.index")->with($message);
        } catch (\Throwable $th) {
            info("log:".$th);
            $message = $this->response("error", "Có lỗi xảy ra, vui lòng thử lại");
            return back()->with($message);
        }
    }
}
