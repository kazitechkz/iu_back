<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\AttemptQuestion;
use App\Models\AttemptSubject;
use App\Models\Subject;
use App\Models\SubTournamentParticipant;
use App\Models\SubTournamentResult;
use App\Models\SubTournamentRival;
use App\Models\Tournament;
use App\Models\User;
use App\Services\AnswerService;
use App\Services\AttemptService;
use App\Services\PlanService;
use App\Services\QuestionService;
use App\Services\TournamentService;


class TestController extends Controller
{
    private QuestionService $_questionService;
    private AttemptService $_attemptService;
    private AnswerService $_answerService;
    public function __construct(QuestionService $questionService,AttemptService $attemptService,AnswerService $answerService)
    {
        $this->_questionService = $questionService;
        $this->_attemptService = $attemptService;
        $this->_answerService = $answerService;
    }


    public function test(){
        //We need locale_id, subjects = [1,2], type_id,time
        $questions = $this->_questionService->get_questions_with_subjects([5,6,],1);
        $points = $this->_questionService->get_questions_max_point($questions);
        $attempt = $this->_attemptService->create_attempt(type_id: 2,locale_id: 1,max_points:$points,questions: $questions,time: 240 );
        dd($attempt);
    }

    public function answerTest(){

            $answers = ["a","b","c","d","e","f","g"];
            $attempt_ids = SubTournamentResult::where("sub_tournament_id",12)->pluck("attempt_id","attempt_id");
            $attempts = Attempt::whereIn("id",$attempt_ids)->get();
            foreach ($attempts as $attempt){
                $user_id = $attempt->user_id;
                $attempt_subjects = AttemptSubject::where(["attempt_id" => $attempt->id])->pluck("id");
                foreach ($attempt_subjects as $attempt_subject){
                    $right_answer = $answers[array_rand($answers,1)];
                    $questions = AttemptQuestion::where(["attempt_subject_id" => $attempt_subjects])->get();
                    foreach ($questions as $question){
                        $this->_answerService->check($user_id,$attempt->id,$attempt_subject,$question->question_id,$right_answer,3);
                    }
                }
            }
            dd($attempts);

        $this->_answerService->check(1,1,12811,"c");
    }

    public function finishTest(){
        //$questions = $this->_questionService->get_questions_with_subjects([5],1,QuestionService::CASUAL_TYPE);
        //$count = $this->_questionService->get_questions_max_point($questions);
        //$this->_attemptService->create_attempt(auth()->user()->id,QuestionService::CASUAL_TYPE,1,$count,$questions,60);
        //$this->_answerService->finish_test(1);
        $answers = ["a","b","c","d","e","f","g"];
        $attempt = Attempt::whereIn("id",[1])->first();
        $attempt_subjects = AttemptSubject::where(["attempt_id" => $attempt->id])->pluck("id");
        foreach ($attempt_subjects as $attempt_subject){
            $right_answer = $answers[array_rand($answers,1)];
            $questions = AttemptQuestion::where(["attempt_subject_id" => $attempt_subjects])->get();
            foreach ($questions as $question){
                $this->_answerService->check(auth()->id(),$attempt->id,$attempt_subject,$question->question_id,$right_answer,3);
            }
        }

    }

    public function subjectTest(){
        $planService = new PlanService();
        dd($planService->get_subjects());
    }

    public function participate(){
        $data = Tournament::first();
        $tournament_service = new TournamentService();
        $users = User::inRandomOrder()->take(100)->pluck("id");
        $sub_tournament_id = 9;
        foreach ($users as $user){
            $tournament_service->participate($user,$sub_tournament_id);
        }
    }

    public function create_attempt(){
        $tournament_service = new TournamentService();
        $users = SubTournamentParticipant::where("sub_tournament_id",12)->pluck("user_id","user_id");
        foreach ($users as $user){
            $tournament_service->get_questions($user,12,1);
       }

    }






}
