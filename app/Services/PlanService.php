<?php

namespace App\Services;

use App\Models\CommercialGroup;
use App\Models\CommercialGroupPlan;
use App\Models\Subject;

class PlanService
{
    public function get_subjects(){
        $subject_plans = auth()->guard("api")->user()->activeSubscriptions()->pluck("tag");
        if(count($subject_plans) == 0){
            return null;
        }
        return Subject::whereIn("id",$this->getIDSFromTag($subject_plans))->with("image")->get();
    }
    public function get_subjects_ids(){
        $subject_plans = auth()->guard("api")->user()->activeSubscriptions()->pluck("tag");
        if(count($subject_plans) == 0){
            return null;
        }
        return Subject::whereIn("id",$this->getIDSFromTag($subject_plans))->pluck('id');
    }
    public function get_closed_subjects(){
        $subject_plans = auth()->guard("api")->user()->activeSubscriptions()->pluck("tag");
        if(count($subject_plans) == 0){
            return null;
        }
        return Subject::whereNotIn("id",$this->getIDSFromTag($subject_plans))->get();
    }
    public static function check_user_subject(int $subject_id): bool
    {
        $pl = new self();
        $subject_plans = auth()->guard('api')->user()->activeSubscriptions()->pluck("tag")->toArray();
        return in_array($subject_id, $pl->getIDSFromTag($subject_plans));
    }
    public function check_user_subject_for_attempt_settings(int $subject_id): bool
    {
        $subject_plans = auth()->guard('api')->user()->activeSubscriptions()->pluck("tag")->toArray();
        return in_array($subject_id, $this->getIDSFromTag($subject_plans));
    }

    public function getIDSFromTag($subs): array
    {
        $data = [];
        foreach ($subs as $item) {
            $data[explode('.',$item)[0]] = explode('.',$item)[0];
        }
        return $data;
    }

    public static function checkIsExistSubscriptions(): bool
    {
        $subs = auth()->guard('api')->user()->activeSubscriptions();
        if ($subs->count()) {
            return true;
        } else {
            return false;
        }
    }
}
