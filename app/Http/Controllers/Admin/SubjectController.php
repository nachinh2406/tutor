<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use App\Models\Subject;
use App\Models\SubjectCategory;

class SubjectController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('can:admin.subjects.index')->only('index');
        $this->middleware('can:admin.subjects.store')->only(['create','store']);
        $this->middleware('can:admin.subjects.update')->only(['edit', 'update']);
        $this->middleware('can:admin.subjects.destroy')->only('destroy');
    }
    public function index()
    {
        $subjects = Subject::select("id", "name", "category_subject_id", "status as status_custom")->with("category:id,name")->get();
        return view("backend.subjects.index", compact("subjects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjectCategories = SubjectCategory::where("status",ACTIVE)->get();
        return view("backend.subjects.create", compact("subjectCategories"));
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
            Subject::create($request->all());
            $message = $this->response("success", "Thêm hợp đồng thành công");
            return redirect()->route("admin.subjects.index")->with($message);
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
    public function edit(Subject $subject)
    {
        $subjectCategories = SubjectCategory::where("status",ACTIVE)->get();
        return view("backend.subjects.edit", compact("subject", "subjectCategories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        try {
            $subject->update([
                'name' => $request->name,
                'category_subject_id' => $request->category_subject_id,
                'status' => $request->status,
            ]);
            $message = $this->response("success", "Cập nhật môn học thành công");
            return redirect()->route("admin.subjects.index")->with($message);
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
    public function destroy(Subject $subject)
    {
        try {
            $subject->delete();
            $message = $this->response("success", "Xóa môn học thành công");
            return redirect()->route("admin.subjects.index")->with($message);
        } catch (\Throwable $th) {
            info("log:".$th);
            $message = $this->response("error", "Có lỗi xảy ra, vui lòng thử lại");
            return back()->with($message);
        }
    }
}
