<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;

class CommonApiController extends Controller
{
    public function getAdministrativeUnits(Request $request) {
        switch ($request->type) {
            case PROVINCE:
                return District::where("matp", $request->value)->get();
                break;
            case DISTRICT:
                return Ward::where("maqh", $request->value)->get();
                break;
        }
    }
    public function getEvents(Request $request, $modelId) {
        if ($request->model == "CLASS_REGISTER") {
            $events = Calendar::where("class_register_id", $modelId)
            ->selectRaw("id,CONCAT(`date`,' ',`start_time`) as start, CONCAT(`date`,' ',`end_time`) as end")
            ->get();
            return response()->json([
                "success"=>true,
                "data"=>$events
            ],200);
        }
        else {

        }
    }
}
