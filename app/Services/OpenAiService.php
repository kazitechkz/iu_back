<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\OpenAiQuestion;
use App\Models\Question;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class OpenAiService
{
    public const OPEN_AI_TOKEN = "OPEN_AI_KEY";
    public const OPEN_AI_MODEL = "gpt-4-turbo-preview";
    public const OPEN_AI_ROLE = "user";

    public const OPEN_AI_URL = "https://api.openai.com/v1/chat/completions";

    public const MAX_REQUEST_PER_DAY = 30;


    public function checkPermissionToAI($user)
    {
        $limit = OpenAiQuestion::where(["user_id" => $user->id])->whereBetween("created_at",[Carbon::now()->startOfDay(),Carbon::now()->endOfDay()])->count();
        if($limit > self::MAX_REQUEST_PER_DAY){
            throw new BadRequestException("Вы исчерпали лимит на сегодня:".$limit . " из " . self::MAX_REQUEST_PER_DAY);
        }
    }


    public function getQuestionRightAnswerAndExplanation($question_id, User $user)
    {
        $question = Question::with("context", "subject")->find($question_id);
        if (!$question) {
            throw new NotFoundException("Не найден вопрос!");
        }
        if ($user->activeSubscriptions()->count() < 1) {
            throw new BadRequestException("Приобритите план подписок");
        }
        $resultArray = [];
        foreach ($user->activeSubscriptions()->pluck("tag", "tag") as $key => $value) {
            $keyParts = explode('.', $key);
            $integerPart = $keyParts[0];
            if (!in_array($integerPart, $resultArray)) {
                $resultArray[] = intval($integerPart);
            }
        }
        if (!in_array($question->subject_id, $resultArray)) {
            throw new BadRequestException("Приобритите план подписок для дисциплины:" . $question->subject->title_ru);
        }
        $questionText = self::getRequestQuestionText($question);
        $answer = self::sendOpenApiRequest($questionText);
        if($answer){
            OpenAiQuestion::add([
                "user_id"=>$user->id,
                "question_id"=>$question->id,
                "answer"=>$answer
            ]);
        }
        return $answer;

    }

    public static function getRequestQuestionText(Question $question)
    {
        $questionText = "";
        if ($question->locale_id == 1) {
            $questionText .= "Cұраққа жауап беріңіз және шешімді қысқаша түсіндіріңіз:";
            $questionText .= $question->text;
            if ($question->context) {
                $questionText .= $question->context->context;
            }
            $questionText .= "Опциялардан дұрыс жауапты таңдаңыз:";
            if ($question->answer_a) {
                $questionText .= "a)" . $question->answer_a;
            }
            if ($question->answer_b) {
                $questionText .= "b)" . $question->answer_b;
            }
            if ($question->answer_c) {
                $questionText .= "c)" . $question->answer_c;
            }
            if ($question->answer_d) {
                $questionText .= "d)" . $question->answer_d;
            }
            if ($question->answer_e) {
                $questionText .= "e)" . $question->answer_e;
            }
            if ($question->answer_f) {
                $questionText .= "f)" . $question->answer_f;
            }
            if ($question->answer_g) {
                $questionText .= "g)" . $question->answer_g;
            }
            if ($question->answer_h) {
                $questionText .= "h)" . $question->answer_h;
            }
            if ($question->type_id == 3) {
                $questionText .= "Ескерту-бірнеше дұрыс жауаптар болуы мүмкін";
            }
        } else {
            $questionText .= "Ответьте на вопрос и кратко объясните решение:";
            $questionText .= $question->text;
            if ($question->context) {
                $questionText .= $question->context->context;
            }
            $questionText .= "Выберите из вариантов верный ответ:";
            if ($question->answer_a) {
                $questionText .= "a)" . $question->answer_a;
            }
            if ($question->answer_b) {
                $questionText .= "b)" . $question->answer_b;
            }
            if ($question->answer_c) {
                $questionText .= "c)" . $question->answer_c;
            }
            if ($question->answer_d) {
                $questionText .= "d)" . $question->answer_d;
            }
            if ($question->answer_e) {
                $questionText .= "e)" . $question->answer_e;
            }
            if ($question->answer_f) {
                $questionText .= "f)" . $question->answer_f;
            }
            if ($question->answer_g) {
                $questionText .= "g)" . $question->answer_g;
            }
            if ($question->answer_h) {
                $questionText .= "h)" . $question->answer_h;
            }
            if ($question->type_id == 3) {
                $questionText .= "Примечание - правильных ответов может быть несколько";
            }
        }
        return $questionText;
    }

    public static function sendOpenApiRequest($text)
    {
        $response = Http::timeout(180)->withHeaders(["Authorization" => "Bearer " . env(self::OPEN_AI_TOKEN)])->post(self::OPEN_AI_URL,
            [
                "model" => self::OPEN_AI_MODEL,
                "messages" => [
                    [
                        "role"=>self::OPEN_AI_ROLE,
                        "content"=>$text
                    ]
                ]
            ]
        );
        if($response->status() == 200){
            $body = json_decode($response->body(),true);
            try{
                $answer = $body["choices"][0]["message"]["content"];
                return $answer;
            }
            catch (\Exception $exception){
                throw new BadRequestException("Ошибка Сервиса! Попробуйте позже.");
            }
        }
        else{
            if($response->status() == 500){
                throw new BadRequestException("Ошибка Сервиса! Попробуйте позже.");
            }
            if($response->status() == 400){
                throw new BadRequestException("Ошибка вопроса! Попробуйте позже.");
            }
            else{
                throw new BadRequestException("Что-то пошло не так! Попробуйте позже.");
            }

        }
    }
}

