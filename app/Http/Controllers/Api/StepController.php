<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Step;
use App\Models\StepResult;
use App\Models\Subject;
use App\Services\StepService;
use App\Traits\ResponseJSON;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StepController extends Controller
{
    private StepService $stepService;

    public function __construct(StepService $stepService)
    {
        $this->stepService = $stepService;
    }

    public function getSteps()
    {
        try {
            $steps = Subject::with('image')->withCount(['steps', 'subSteps'])->get();
            foreach ($steps as $key => $step) {
                $result = StepResult::firstWhere(['user_id' => auth()->guard('api')->id(), 'step_id' => $step->id]);
                if ($result) {
                    $steps[$key]['progress'] = $result->user_point;
                } else {
                    $steps[$key]['progress'] = 0;
                }
            }
            return response()->json(new ResponseJSON(
                status: true, data: $steps
            ));
        } catch (Exception $exception) {
            return response()->json(new ResponseJSON(status: false, errors: $exception->getMessage()), 500);
        }
    }

    public function getStepDetail($id)
    {
        try {
            $steps = Step::with(['image', 'result'])->where('subject_id', $id)->orderBy('level', 'desc')->get();
            foreach ($steps as $key => $step) {
                if ($step->result) {
                    $steps[$key]['progress'] = $step->result->user_point;
                } else {
                    $steps[$key]['progress'] = 0;
                }
            }
            return response()->json(new ResponseJSON(
                status: true, data: $steps
            ));
        } catch (Exception $exception) {
            return response()->json(new ResponseJSON(status: false, errors: $exception->getMessage()), 500);
        }
    }

    public function getSubSteps()
    {

    }

    public function getStepTests(int $sub_step_id, int $locale_id)
    {
        try {
            $results = $this->stepService->getSubStepTests($sub_step_id, $locale_id);
            if ($results != null) {
                return response()->json(new ResponseJSON(
                    status: true,
                    data: $results
                ));
            } else {
                return response()->json(new ResponseJSON(
                    status: false,
                    errors: "Недостаточно прав!"
                ), 403);
            }
        } catch (Exception $exception) {
            return response()->json(new ResponseJSON(status: false, errors: $exception->getMessage()), 500);
        }
    }

    public function passTest(Request $request)
    {
        try {
            $this->validate($request, [
                'sub_step_id' => 'required|exists:sub_step_tests,id',
                'user_answer' => 'required'
            ]);
            return response()->json(new ResponseJSON(
                status: true,
                data: $this->stepService->check($request['sub_step_id'], $request['user_answer'], auth()->id())
            ));
        } catch (ValidationException $exception) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $exception->errors()
            ));
        }
    }
}
