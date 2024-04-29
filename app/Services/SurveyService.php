<?php

namespace App\Services;

use App\Events\WalletEvent;
use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\SurveyQuestion;
use App\Models\User;
use App\Models\UserSurvey;

class SurveyService
{
    public function getActiveSurveys($localeID)
    {
        $user = auth()->guard('api')->user();
        if ($user->activeSubscriptions()->count()) {
            return $this->checkSurvey(true, $user, $localeID);
        } else {
            return $this->checkSurvey(false, $user, $localeID);
        }
    }
    public function postAnswerSurveys($request)
    {
        $user = auth()->guard('api')->user();
        UserSurvey::firstOrCreate([
           'survey_id' => $request['survey_id'],
           'user_id' => $user->id
        ]);
        if ($request['questions'] && count($request['questions']) > 0) {
            foreach ($request['questions'] as $question) {
                SurveyAnswer::firstOrCreate([
                    'survey_question_id' => $question['survey_question_id'],
                    'survey_id' => $request['survey_id'],
                    'user_id' => $user->id,
                    'answer' => array_key_exists('answer', $question) ? $question['answer'] : null,
                    'input' => array_key_exists('input', $question) ? $question['input'] : null,
                    'wishes' => array_key_exists('wishes', $question) ? $question['wishes'] : null,
                ]);
            }
        }
        $user->deposit(1000);
        event(new WalletEvent($user->balanceInt));
    }
    protected function checkSurvey(bool $is_subs, User $user, int $localeID)
    {
        $query = Survey::query();
        $survey = $query->where(['status' => 1, 'is_subscription' => $is_subs])->with('survey_questions', function ($q) use ($localeID) {
            $q->where('locale_id', $localeID)->orderBy('order', 'asc');
        })->latest()->first();
        if ($survey) {
            if (!UserSurvey::where(['survey_id' => $survey->id, 'user_id' => $user->id])->first()) {
                return $survey;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    public function getSurveyStats($surveyID, $localeID): array
    {
        $data = [];
        $ids = SurveyQuestion::where(['survey_id' => $surveyID, 'locale_id' => $localeID])->pluck('id', 'text');
        foreach ($ids as $k => $v) {
            $ans = SurveyAnswer::whereNotNull('answer')->where(['survey_id' => $surveyID, 'survey_question_id' => $v])->get();
            foreach ($ans as $an) {
                $data[$k][$this->getQuestionAnswerText($an)][] = $an->input != null ? $an->input : 1;
            }
        }
        return $data;
    }

    public function getWishes($surveyID, $localeID)
    {
        return SurveyAnswer::where('survey_id', $surveyID)
            ->whereNotNull('wishes')
            ->whereHas('survey_question', function ($q) use ($localeID) {
                $q->where('locale_id', $localeID);
            })
            ->with('user')
            ->paginate(20);
    }

    protected function getQuestionAnswerText($an)
    {
        $answer = $an->answer;
        $question = SurveyQuestion::find($an->survey_question_id);
        if ($question) {
            return $question->$answer;
        } else {
            return $answer;
        }
    }
}
