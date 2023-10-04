<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubStep;
use App\Models\SubStepContent;
use App\Traits\ResponseJSON;
use Exception;
use Illuminate\Http\Request;

class SubStepController extends Controller
{
    public function getSubStepsByStepId(int $id)
    {
        try {
            $subSteps = SubStep::with('sub_result')->where('step_id', $id)->orderBy('level', 'asc')->get();
            foreach ($subSteps as $key => $subStep) {
                if ($subStep->sub_result) {
                    $subSteps[$key]['progress'] = $subStep->sub_result->user_point;
                } else {
                    $subSteps[$key]['progress'] = 0;
                }
            }
            return  response()->json(new ResponseJSON(status: true, data: $subSteps));
        } catch (Exception $exception) {
            return response()->json(new ResponseJSON(status: false, errors: $exception->getMessage()), 500);
        }
    }

    public function getSubStepById($id)
    {
        try {
            $subStep = SubStep::with(['sub_step_content', 'sub_step_video'])->where('id', $id)->orderBy('level', 'asc')->first();
            return  response()->json(new ResponseJSON(status: true, data: $subStep));
        } catch (Exception $exception) {
            return response()->json(new ResponseJSON(status: false, errors: $exception->getMessage()), 500);
        }
    }
}
