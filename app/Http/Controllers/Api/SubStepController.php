<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubStep;
use App\Models\SubStepContent;
use App\Models\SubStepResult;
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
                    $resKk = $subStep->sub_result->firstWhere('locale_id', 1);
                    $resRu = $subStep->sub_result->firstWhere('locale_id', 2);
                    if ($resKk) {
                        $subSteps[$key]['progress_kk'] = $resKk->user_point;
                    } else {
                        $subSteps[$key]['progress_kk'] = 0;
                    }
                    if ($resRu) {
                        $subSteps[$key]['progress_ru'] = $resRu->user_point;
                    } else {
                        $subSteps[$key]['progress_ru'] = 0;
                    }
                } else {
                    $subSteps[$key]['progress_kk'] = 0;
                    $subSteps[$key]['progress_ru'] = 0;
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
            $subStep = SubStep::with(['sub_step_content', 'sub_step_video', 'sub_result'])->where('id', $id)->orderBy('level', 'asc')->first();
            return  response()->json(new ResponseJSON(status: true, data: $subStep));
        } catch (Exception $exception) {
            return response()->json(new ResponseJSON(status: false, errors: $exception->getMessage()), 500);
        }
    }

    public function checkSubStepResultByUser(Request $request)
    {
        try {
            $this->validate($request, [
               'sub_step_id' => 'required',
               'locale_id' => 'required'
            ]);
            $subStepResult = SubStepResult::firstWhere(['sub_step_id' => $request['sub_step_id'], 'locale_id' => $request['locale_id'], 'user_id' => auth()->guard('api')->id()]);
            if ($subStepResult) {
                return  response()->json(new ResponseJSON(status: true, data: true));
            } else {
                return  response()->json(new ResponseJSON(status: true, data: false));
            }
        } catch (Exception $exception) {
            return response()->json(new ResponseJSON(status: false, errors: $exception->getMessage()), 500);
        }
    }
}
