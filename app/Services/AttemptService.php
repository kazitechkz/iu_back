<?php

namespace App\Services;

use App\DTOs\AttemptDTO;
use App\DTOs\SubjectQuestionDTO;
use App\Exceptions\AttemptException;
use App\Models\Attempt;
use App\Models\AttemptQuestion;
use App\Models\AttemptSubject;
use App\Models\Question;
use App\Models\Subject;
use Carbon\Carbon;

class AttemptService
{


    public function create_attempt(int $user_id,int $type_id,int $locale_id,int $max_points,$questions,int $time){
        try {
            //Create Attempt
            $attempt = Attempt::add(["start_at"=>Carbon::now(),"type_id"=>$type_id,"user_id"=>$user_id,"locale_id"=>$locale_id,"max_points"=>$max_points,"time"=>$time,"time_left"=>$time]);
            //Questions = [1=>[]]
            $subjects = array_keys($questions);
            $attempts_dto = [];
            $attempt_subject_ids = [];
            $raw_data = [];
            foreach ($subjects as $subject){
                //Add Attempt Subject
                $attempt_subject = AttemptSubject::add(["attempt_id"=>$attempt->id,"subject_id"=>$subject]);
                foreach ($questions[$subject] as $question){
                    array_push($raw_data,["attempt_subject_id"=>$attempt_subject->id,"question_id"=>$question["id"]]);
                }
                $attempt_subject_ids[$subject] = $attempt_subject->id;
            }
            AttemptQuestion::insert($raw_data);
            return $attempt->id;
        }
        catch (\Exception $exception){
            throw new AttemptException($exception->getMessage());
        }
    }

    public function get_attempt_by_id($attempt_id,$hide_correct = true){
        $attempts_dto = [];
        $attempt = Attempt::find($attempt_id);
        if(!$attempt->end_at){
            $attempt->update(['time_left'=>$attempt->time - Carbon::now()->diffInMilliseconds($attempt->start_at)]);
        }
        $subject_dtos = [];
        $attempt_subjects = AttemptSubject::where(["attempt_id"=>$attempt->id])->with("subject")->get();
        $attempts_dto["attempt_id"] = $attempt->id;
        $attempts_dto["type_id"] = $attempt->type_id;
        $attempts_dto["time_left"] = $attempt->time_left;
        $attempts_dto["start_at"] = $attempt->start_at;
        foreach ($attempt_subjects as $attempt_subject){
            $subject_dto["title_ru"] = $attempt_subject->subject->title_ru;
            $subject_dto["title_kk"] = $attempt_subject->subject->title_kk;
            $subject_dto["attempt_subject_id"] = $attempt_subject->id;
            $questions_attempt = AttemptQuestion::where(["attempt_subject_id"=>$attempt_subject->id])->pluck("question_id")->toArray();
            $idsImploded = implode(',',$questions_attempt);
            $question_query = Question::whereIn("id",$questions_attempt)
                ->orderByRaw("field(id,{$idsImploded})")
                ->with("context")->get();
            $questions = $hide_correct ? $question_query->makeHidden(QuestionService::getHidden($attempt->type_id,$attempt_id))->toArray() : $question_query->toArray();
            $subject_dto["question"] = $questions;
            array_push($subject_dtos,$subject_dto);
        }
        $attempts_dto["subject_questions"] = $subject_dtos;
        return $attempts_dto;
    }







}
