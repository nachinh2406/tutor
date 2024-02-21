<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\PermissionService;
use App\Models\ClassRegister;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function dashboard()
    {
        return view('backend.dashboard.index');
    }
    public function getClassRegisterMonth(Request $request) {
        $stastic = ClassRegister::select(DB::raw('count(id) as total'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->whereYear('created_at', '=', Carbon::now()->format("Y"))
        ->get();
        $year = [0,0,0,0,0,0,0,0,0,0,0,0]; // giá trị mặc định ban đầu
        foreach($stastic as $key) {
        $year[$key->month-1] = $key->total;
        }
        return $year;
    }
}
