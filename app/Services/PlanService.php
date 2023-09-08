<?php

namespace App\Services;

use App\Models\CommercialGroup;
use App\Models\CommercialGroupPlan;
use App\Models\Subject;

class PlanService
{
    public function get_subjects(){
        $subject_plans = auth()->user()->activeSubscriptions()->pluck("tag");
        if(count($subject_plans) == 0){
            return null;
        }
        return Subject::whereIn("id",$subject_plans)->get();
    }


    public function get_closed_subjects(){
        $subject_plans = auth()->user()->activeSubscriptions()->pluck("tag");
        if(count($subject_plans) == 0){
            return null;
        }
        return Subject::whereNotIn("id",$subject_plans)->get();
    }
}
