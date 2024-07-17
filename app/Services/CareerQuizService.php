<?php

namespace App\Services;

use App\DTOs\FinishCareerQuizDTO;
use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\CareerQuiz;
use App\Models\CareerQuizAttempt;
use App\Models\CareerQuizAttemptResult;
use App\Models\CareerQuizFeature;
use Illuminate\Support\Facades\DB;

class CareerQuizService
{
    public const CAREER_QUIZ_CODES = [
        [
            "id"=>"ONE_ANSWER",
            "title_ru"=>"Универсальные ответы"
        ],
        [
            "id"=>"QUESTIONS_AND_ANSWERS",
            "title_ru"=>"Вопросы с уникальными ответами"
        ],
        [
            "id"=>"DRAG_DROP",
            "title_ru"=>"Выбор приоритета"
        ],
    ];
    public const CODES_VALIDATION = ["ONE_ANSWER","DRAG_DROP","QUESTIONS_AND_ANSWERS"];
    public const CAREER_ONE_ANSWER = "ONE_ANSWER";
    public const CAREER_DRAG_DROP_ANSWER = "DRAG_DROP";
    public const CAREER_QUESTIONS_AND_ANSWERS = "QUESTIONS_AND_ANSWERS";


    public function finishCareerQuiz(FinishCareerQuizDTO $result) : int
    {
        $user = auth()->guard("api")->user();
        $input = $result->toArray();
        $givenAnswers = json_decode($input["given_answers"], true);
        $careerQuiz = CareerQuiz::with(["career_quiz_questions", "career_quiz_answers"])->find($input["quiz_id"]);
        if($careerQuiz){
            if($careerQuiz->code == self::CAREER_ONE_ANSWER){
                return $this->calculateOneAnswer($careerQuiz,$user,$input,$givenAnswers);
            }
            if($careerQuiz->code == self::CAREER_QUESTIONS_AND_ANSWERS){
                return $this->calculateQuestionsAnswer($careerQuiz,$user,$input,$givenAnswers);
            }
            if($careerQuiz->code == self::CAREER_DRAG_DROP_ANSWER){
                return $this->calcuteDragDrop($careerQuiz,$user,$input,$givenAnswers);
            }
            throw new BadRequestException("Неверный формат");
        }
        else{
            throw new NotFoundException("Не найден тест!");
        }

    }


    public static function calculateOneAnswer(CareerQuiz $careerQuiz, $user,$input,$givenAnswers){
        $max_point = $careerQuiz->career_quiz_answers->max("value");
        $featureGroups = $careerQuiz->career_quiz_questions()
            ->select("feature_id", DB::raw('count(*) as question_count'))
            ->groupBy("feature_id")
            ->pluck("question_count", "feature_id")
            ->toArray();
        $results = [];
        $percentages = [];
        foreach ($featureGroups as $key => $value) {
            $results[$key] = 0;
            $percentages[$key] = 0;
        }
        foreach ($careerQuiz->career_quiz_questions as $question) {
            $results[$question->feature_id] += $givenAnswers[$question->id];
        }
        foreach ($featureGroups as $key => $value) {
            $percentages[$key] = round($results[$key] / (array_sum($results)) * 100, 2);
        }
        $attempt_raw = [
            "user_id" => $user->id,
            "quiz_id" => $input["quiz_id"],
            "given_answers"=>$input["given_answers"]
        ];
        $attempt = CareerQuizAttempt::add($attempt_raw);
        $attempt_results_raw = [];
        foreach ($featureGroups as $key => $value) {
            array_push($attempt_results_raw, [
                "attempt_id"=>$attempt->id,
                "feature_id" => $key,
                "points" => $results[$key],
                "percentage" => $percentages[$key],
            ]);
        }
        CareerQuizAttemptResult::insert($attempt_results_raw);
        return $attempt->id;
    }

    public function calcuteDragDrop(CareerQuiz $careerQuiz, $user,$input,$givenAnswers){
        $max_point = $careerQuiz->career_quiz_answers->count();
        $careerQuizAnswers = $careerQuiz->career_quiz_answers->pluck("feature_id","id")->toArray();
        $results = [];
        foreach ($careerQuizAnswers as $id => $featureID){
            $results[$featureID] = 0;
        }
        foreach ($givenAnswers as $questionID => $givenAnswer){
            foreach ($givenAnswer as $rating => $answerId){
                $results[$careerQuizAnswers[$answerId]] += $rating;
            }
        }
        $max_point = array_sum($results);
        $attempt_raw = [
            "user_id" => $user->id,
            "quiz_id" => $input["quiz_id"],
            "given_answers"=>$input["given_answers"]
        ];
        $attempt = CareerQuizAttempt::add($attempt_raw);
        $attempt_results_raw = [];
        foreach ($results as $key => $value) {
            array_push($attempt_results_raw, [
                "attempt_id"=>$attempt->id,
                "feature_id" => $key,
                "points" => $results[$key],
                "percentage" => round($results[$key] / ($max_point) * 100, 2),
            ]);
        }
        CareerQuizAttemptResult::insert($attempt_results_raw);
        return $attempt->id;
    }

    public static function calculateQuestionsAnswer(CareerQuiz $careerQuiz, $user,$input,$givenAnswers){
        $max_point_raw = $careerQuiz->career_quiz_answers;
        $max_point_result = [];
        foreach ($max_point_raw as $answer_point){
            if(isset($max_point_result[$answer_point->feature_id])){
                $max_point_result[$answer_point->feature_id] += $answer_point->value;
            }
            else{
                $max_point_result[$answer_point->feature_id] = $answer_point->value;
            }
        }
        $sum = array_sum($max_point_result);
        $count = count($max_point_result);
        $average = round($sum / $count);
        $average = intval($average);
        $featureGroups = $careerQuiz->career_quiz_answers()
            ->pluck("feature_id", "id")
            ->toArray();
        $results = [];
        $percentages = [];
        foreach ($featureGroups as $answer_id => $feature_id) {
            $results[$feature_id] = 0;
            $percentages[$feature_id] = 0;
        }

        foreach ($careerQuiz->career_quiz_questions as $question) {
          $results[$featureGroups[$givenAnswers[$question->id]]] += 1;
        }
        foreach ($featureGroups as $answer_id => $feature_id) {
            $percentages[$feature_id] = round($results[$feature_id] / ($average) * 100, 2);
        }
        $attempt_raw = [
            "user_id" => $user->id,
            "quiz_id" => $input["quiz_id"],
            "given_answers"=>$input["given_answers"]
        ];
        $attempt = CareerQuizAttempt::add($attempt_raw);
        $attempt_results_raw = [];
        foreach ($results as $feature_id => $total) {
            array_push($attempt_results_raw, [
                "attempt_id"=>$attempt->id,
                "feature_id" => $feature_id,
                "points" => $results[$feature_id],
                "percentage" => $percentages[$feature_id],
            ]);
        }
        CareerQuizAttemptResult::insert($attempt_results_raw);
        return $attempt->id;
    }


}
