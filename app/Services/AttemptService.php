<?php

namespace App\Services;

use App\DTOs\AttemptDTO;
use App\DTOs\SubjectQuestionDTO;
use App\Exceptions\AttemptException;
use App\Models\Attempt;
use App\Models\AttemptQuestion;
use App\Models\AttemptSubject;
use App\Models\Subject;
use Carbon\Carbon;

class AttemptService
{


    public function create_attempt(int $user_id,int $type_id,int $locale_id,int $max_points,$questions,int $time){
        try {
            //Create Attempt
            $attempt = Attempt::add(["start_at"=>Carbon::now(),"type_id"=>$type_id,"user_id"=>$user_id,"locale_id"=>$locale_id,"max_points"=>$max_points,"time"=>$time*60000]);
            //Questions = [1=>[]]
            $subjects = array_keys($questions);
            $attempts_dto = [];
            $attempt_subject_ids = [];
            foreach ($subjects as $subject){
                //Add Attempt Subject
                $attempt_subject = AttemptSubject::add(["attempt_id"=>$attempt->id,"subject_id"=>$subject]);
                foreach ($questions[$subject] as $question){
                    AttemptQuestion::add(["attempt_subject_id"=>$attempt_subject->id,"question_id"=>$question["id"]]);
                }
                $attempt_subject_ids[$subject] = $attempt_subject->id;
            }
            foreach ($questions as $subject_id => $question){
                $subject_question = Subject::find($subject_id);
                $subject_dto = SubjectQuestionDTO::fromArray(
                    ["title_ru"=>$subject_question->title_ru,"title_kk"=>$subject_question->title_kk, "question"=>$question,"attempt_subject_id"=>$attempt_subject_ids[$subject_id]]
                );
                array_push($attempts_dto,$subject_dto->data);
            }
            $attempt_dto = AttemptDTO::fromArray(["attempt_id"=>$attempt->id,"time"=>$attempt->time,"subject_questions"=>$attempts_dto]);
            return $attempt_dto->data;
        }
        catch (\Exception $exception){
            throw new AttemptException($exception->getMessage());
        }


    }




}
