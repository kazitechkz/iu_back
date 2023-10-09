<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Step;
use App\Models\StepResult;
use App\Models\Subject;
use App\Models\SubStepContentTest;
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
            $steps = Step::with(['image', 'results'])->where('subject_id', $id)->orderBy('level', 'desc')->get();
            foreach ($steps as $key => $step) {
                if ($step->results) {
                    $resKk = $step->results->firstWhere('locale_id', 1);
                    $resRu = $step->results->firstWhere('locale_id', 2);
                    if ($resKk) {
                        $steps[$key]['progress_kk'] = $resKk->user_point;
                    } else {
                        $steps[$key]['progress_kk'] = 0;
                    }
                    if ($resRu) {
                        $steps[$key]['progress_ru'] = $resRu->user_point;
                    } else {
                        $steps[$key]['progress_ru'] = 0;
                    }
                } else {
                    $steps[$key]['progress_kk'] = 0;
                    $steps[$key]['progress_ru'] = 0;
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
                ), 200);
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

    public function getStepResultExam(int $sub_step_id, int $locale_id)
    {
        try {
            $results = $this->stepService->getSubStepTests($sub_step_id, $locale_id);
            $data = [];
            if ($results) {
                $data['is_right'] = 0;
                $data['count'] = $results->count();
                $data['questions'] = $results;
                foreach ($results as $item) {
                    if ($item->result->is_right) {
                        $data['is_right'] += 1;
                    }
                }
            }
            if ($results != null) {
                return response()->json(new ResponseJSON(
                    status: true,
                    data: $data
                ), 200);
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
            if ($request->all()) {
                foreach ($request->all() as $item) {
                    $this->stepService->check($item['sub_step_id'], $item['answer'], auth()->guard('api')->id(), $item['locale_id']);
                }
//                $results = SubStepContentTest::where()
                return response()->json(new ResponseJSON(
                    status: true,
                    data: true
                ));
            } else {
                return response()->json(new ResponseJSON(
                    status: false,
                    message: "Ничего не выбрано",
                    data: null
                ), 400);
            }
        } catch (ValidationException $exception) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $exception->errors()
            ), 400);
        }
    }
}
