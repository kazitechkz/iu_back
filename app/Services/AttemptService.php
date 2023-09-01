<?php

namespace App\Services;

use App\Models\Attempt;
use App\Models\AttemptQuestion;
use App\Models\AttemptSubject;

class AttemptService
{


    public function create_attempt($type_id,$locale_id,$max_points,$questions,$time):Attempt{
        $attempt = Attempt::add(["type_id"=>$type_id,"user_id"=>auth()->user()->id,"locale_id"=>$locale_id,"max_points"=>$max_points,"time"=>$time]);
        $subjects = array_keys($questions);
        foreach ($subjects as $subject){
            $attempt_subject = AttemptSubject::add(["attempt_id"=>$attempt->id,"subject_id"=>$subject]);
            foreach ($questions[$subject] as $question){
                AttemptQuestion::add(["attempt_subject_id"=>$attempt_subject->id,"question_id"=>$question["id"]]);
            }
        }
        return $attempt;

    }




}
