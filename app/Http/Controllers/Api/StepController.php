<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Step;
use App\Models\StepResult;
use App\Models\Subject;
use App\Models\SubStepContentTest;
use App\Services\ResponseService;
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

    public function getSteps($locale_id)
    {
        try {
            $steps = Subject::whereNotIn('id', [3,13,14,15])->with('image', 'steps.own_result')->withCount(['steps', 'subSteps'])->get();
            foreach ($steps as $key => $step) {
                $steps[$key]['progress'] = 0;
                if ($step->steps) {
                    foreach ($step->steps as $item) {
                        $res = $item->own_result->where('locale_id', $locale_id)->first();
                        if ($res) {
                            $steps[$key]['progress'] = round($res->user_point / $step->steps->count());
                        }
                    }
                }
            }

            return response()->json(new ResponseJSON(
                status: true, data: $steps
            ));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function getStepDetail($id)
    {
        try {
            $steps = Step::with(['image', 'results', 'own_result', 'subject'])->where('subject_id', $id)->orderBy('level', 'desc')->get();
            foreach ($steps as $key => $step) {
                if ($step->results) {
                    $resKk = $step->own_result->firstWhere('locale_id', 1);
                    $resRu = $step->own_result->firstWhere('locale_id', 2);
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
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function getSubSteps()
    {

    }

    public function getStepTests(int $sub_step_id, int $locale_id)
    {
        try {
            $results = $this->stepService->getSubStepTests($sub_step_id, $locale_id);

            if (!$results) {
                return response()->json(new ResponseJSON(
                    status: false,
                    errors: null,
                    data: null
                ));
            }
            if (!$results->count()) {
                return response()->json(new ResponseJSON(
                    status: false,
                    errors: "Недостаточно прав!"
                ), 403);
            }
            return response()->json(new ResponseJSON(
                status: true,
                data: $results
            ));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function getStepResultExam(int $sub_step_id, int $locale_id)
    {
        try {
            $results = $this->stepService->getSubStepTests($sub_step_id, $locale_id);
            $data = [];
            $data['is_right'] = 0;
            if ($results) {
                $data['count'] = $results->count();
                $data['questions'] = $results;
                foreach ($results as $item) {
                    if ($item->result) {
                        if ($item->result->is_right) {
                            $data['is_right'] += 1;
                        }
                    }
                }
                return response()->json(new ResponseJSON(
                    status: true,
                    data: $data
                ));
            } else {
                return response()->json(new ResponseJSON(
                    status: false,
                    errors: "Неизвестная ошибка!"
                ));
            }
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function passTest(Request $request)
    {
        try {
            if ($request->all()) {
                foreach ($request->all() as $item) {
                    $this->stepService->check($item['sub_step_test_id'], $item['answer'], auth()->guard('api')->id(), $item['locale_id']);
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
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
