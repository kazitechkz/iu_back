<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContentAppeal;
use App\Models\SubStep;
use App\Models\SubStepContent;
use App\Models\SubStepResult;
use App\Services\ResponseService;
use App\Services\StepService;
use App\Traits\ResponseJSON;
use Exception;
use Illuminate\Http\Request;

class SubStepController extends Controller
{
    private StepService $stepService;

    public function __construct(StepService $stepService)
    {
        $this->stepService = $stepService;
    }
    public function getSubStepsByStepId(int $id)
    {
        try {
            $subSteps = SubStep::with(['sub_result' => function($q) {
                $q->where('user_id', auth()->guard('api')->id());
            }, 'own_result', 'step'])->where('step_id', $id)->orderBy('level', 'asc')->get();
            foreach ($subSteps as $key => $subStep) {
                $accept = $this->stepService->checkStepAccept($subStep->step);
                if ($accept) {
                    $subSteps[$key]['is_free'] = true;
                } else {
                    $subSteps[$key]['is_free'] = false;
                }
                if ($subStep->sub_result) {
                    $resKk = $subStep->own_result->firstWhere('locale_id', 1);
                    $resRu = $subStep->own_result->firstWhere('locale_id', 2);
                    if ($resKk) {
                        $subSteps[$key]['progress_kk'] = intval($resKk->user_point);
                    } else {
                        $subSteps[$key]['progress_kk'] = 0;
                    }
                    if ($resRu) {
                        $subSteps[$key]['progress_ru'] = intval($resRu->user_point);
                    } else {
                        $subSteps[$key]['progress_ru'] = 0;
                    }
                } else {
                    $subSteps[$key]['progress_kk'] = 0;
                    $subSteps[$key]['progress_ru'] = 0;
                }
            }
            return  response()->json(new ResponseJSON(status: true, data: $subSteps));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function getSubStepById($id)
    {
        try {
            $subStep = SubStep::with(['sub_step_content', 'sub_step_video', 'sub_result', 'step'])->where('id', $id)->orderBy('level', 'asc')->first();
            if ($subStep) {
                $accept = $this->stepService->checkStepAccept($subStep->step);
                if ($accept) {
                    return  response()->json(new ResponseJSON(status: true, data: $subStep));
                } else {
                    return  response()->json(new ResponseJSON(status: false, message: "Недостаточно прав!"), 403);
                }
            } else {
                return  response()->json(new ResponseJSON(status: false, message: "Что-то пошло не так!"), 500);
            }
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function getSubStepBySubCategoryId(Request $request)
    {
        try {
            $this->validate($request, ['sub_category_id' => 'required|exists:sub_categories,id']);
            $subSteps = SubStep::where('sub_category_id', $request['sub_category_id'])->get();
            if ($subSteps->count() > 0) {
                $accept = $this->stepService->checkStepAccept($subSteps[0]->step);
                if ($accept) {
                    return  response()->json(new ResponseJSON(status: true, data: $subSteps));
                } else {
                    return  response()->json(new ResponseJSON(status: false, message: "Недостаточно прав!", data: null), 403);
                }
            } else {
                return  response()->json(new ResponseJSON(status: false, message: "Что-то пошло не так!"), 500);
            }
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
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
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function createContentAppeal(Request $request)
    {
        try {
            $this->validate($request, [
                'content_id' => 'required'
            ]);
            $userID = auth()->guard('api')->id();
            $contentAppeal = ContentAppeal::firstWhere(['content_id' => $request['content_id'], 'user_id' => $userID]);
            if ($contentAppeal) {
                return  response()->json(new ResponseJSON(status: false, data: false));
            } else {
                ContentAppeal::create([
                    'content_id' => $request['content_id'],
                    'user_id' => $userID,
                    'status' => false
                ]);
                return  response()->json(new ResponseJSON(status: true, data: true));
            }
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
