<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\ClassRegister;
use App\Models\ClassSchool;
use App\Models\Contact;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ResponseTrait;
    public function index() {
        $commentUsers = User::whereNotNull("comment")->get();
        $users = User::where("status",ACTIVE)->where("is_honnor",ACTIVE)->limit(8)->get();
        $newClasses = ClassRegister::where("status",ACTIVE)
        ->with(["subject","ward","district","province", "users:id,name"])
        ->orderBy("id","DESC")->limit(10)->get();
        return view("frontend.home",compact("commentUsers", "newClasses","users"));
    }
    public function contract() {
        $contract = Contract::where("type",ACTIVE)->where("status",ACTIVE)->first();
        return view("frontend.contract",compact("contract"));
    }
    public function pageContact(Request $request) {
        if($request->isMethod("post")) {
            Contact::create($request->all());
            return back()->with($this->response("success","Gửi yêu cầu thành công!"));
        }
        return view("frontend.contact");
    }
}
