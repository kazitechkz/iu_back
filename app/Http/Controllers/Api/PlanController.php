<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CommercialGroupPlan;
use App\Models\GroupPlan;
use App\Models\Step;
use App\Models\SubStep;
use App\Models\SubStepContent;
use App\Models\SubStepTest;
use App\Models\SubStepVideo;
use App\Services\PlanService;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Bpuig\Subby\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private PlanService $_planService;

    public function __construct(PlanService $planService)
    {
        $this->_planService = $planService;
    }

    public function index()
    {
        try {
            $plans = Plan::all();
            return response()->json(new ResponseJSON(status: true, data: $plans), 500);

        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }


    public function getUNTPlan()
    {
        try {
            $plan_ids = CommercialGroupPlan::whereHas("commercial_group", function ($q) {
                $q->where(["tag" => "unt"]);
            })->pluck("plan_id", "plan_id")->toArray();
            $plans = Plan::whereIn("id", $plan_ids)->where("tag", "!=", "free")->get();
            return response()->json(new ResponseJSON(status: true, data: $plans), 200);

        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function getLearningPlan()
    {
        try {
            $plan_ids = CommercialGroupPlan::whereHas("commercial_group", function ($q) {
                $q->where(["tag" => "content"]);
            })->pluck("plan_id", "plan_id")->toArray();
            $plans = Plan::whereIn("id", $plan_ids)->get();
            $result = ["plans" => $plans, "stat" => []];
            if ($plans) {
                $statId = 0;
                foreach ($plans as $plan) {
                    $step_ids = Step::where(["subject_id" => $plan->tag])->pluck("id", "id")->toArray();
                    $sub_step_ids = SubStep::whereIn("step_id", $step_ids)->pluck("id", "id")->toArray();
                    $result["stat"][$statId]["subject_id"] = $plan->tag;
                    $result["stat"][$statId]["steps"] = count($step_ids);
                    $result["stat"][$statId]["sub_steps"] = count($sub_step_ids);
                    $result["stat"][$statId]["videos"] = SubStepVideo::whereIn("sub_step_id", $sub_step_ids)->count();
                    $result["stat"][$statId]["contents"] = SubStepContent::whereIn("sub_step_id", $sub_step_ids)->count();
                    $result["stat"][$statId]["questions"] = SubStepTest::whereIn("sub_step_id", $sub_step_ids)->count();
                    $statId++;
                }
            }
            return response()->json(new ResponseJSON(status: true, data: $result), 200);

        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function checkPlanUNT()
    {
        try {
            $result = $this->_planService->get_subjects_ids();
            return response()->json(new ResponseJSON(status: true, data: $result));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
