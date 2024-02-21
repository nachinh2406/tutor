<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;

class ContractController extends Controller
{
    use ResponseTrait;

    public function __construct()
    {
        $this->middleware('can:admin.contracts.index')->only('index');
        $this->middleware('can:admin.contracts.store')->only(['create','store']);
        $this->middleware('can:admin.contracts.update')->only(['edit', 'update']);
        $this->middleware('can:admin.contracts.destroy')->only('destroy');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::select("id","code","title", "content", "created_at as created_at_custom", "type as type_custom", "status as status_custom")->get();
        return view("backend.contracts.index", compact("contracts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.contracts.create");
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
            $data->code = "HĐ_".mt_rand(1000000, 9999999);
            Contract::create((array) $data);
            $message = $this->response("success", "Thêm hợp đồng thành công");
            return redirect()->route("admin.contracts.index")->with($message);
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
    public function edit(Contract $contract)
    {
        return view("backend.contracts.edit", compact("contract"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        try {
            $contract->update([
                'title' => $request->title,
                'content' => $request->content,
                'type' => $request->type,
                'status' => $request->status,
            ]);
            $message = $this->response("success", "Cập nhật hợp đồng thành công");
            return redirect()->route("admin.contracts.index")->with($message);
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
    public function destroy(Contract $contract)
    {
        try {
            $contract->delete();
            $message = $this->response("success", "Xóa hợp đồng thành công");
            return redirect()->route("admin.contracts.index")->with($message);
        } catch (\Throwable $th) {
            info("log:".$th);
            $message = $this->response("error", "Có lỗi xảy ra, vui lòng thử lại");
            return back()->with($message);
        }
    }
}
