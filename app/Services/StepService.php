<?php

namespace App\Services;

use App\Models\Question;
use App\Models\Step;
use App\Models\StepResult;
use App\Models\SubStep;
use App\Models\SubStepContentTest;
use App\Models\SubStepResult;
use App\Models\SubStepTest;
use App\Models\UserStepsBonus;

class StepService
{
    /**
     * @param int $sub_step_id = SubStepId айди Субраздела
     */
    public function getSubStepTests(int $sub_step_id, int $locale_id): \Illuminate\Database\Eloquent\Collection|array|null
    {
        $subStep = SubStep::with('step')->findOrFail($sub_step_id);
        $tests = SubStepTest::with(['result', 'question' => function($query) use ($locale_id) {
            $query->where(['locale_id' => $locale_id])->with('context');
        } ])->where(['sub_step_id' => $sub_step_id, 'locale_id' => $locale_id])->get();
        if ($subStep->step->is_free) {
            return $tests;
        } else {
            if (PlanService::check_user_subject($subStep->step->subject_id)) {
                return $tests;
            } else {
                return null;
            }
        }
    }

    /**
     * @param int $sub_step_test_id = SubStepTestId айди вопроса
     * @param $user_answer = UserAnswer ответ пользователя
     * @param int $user_id = UserId айди пользователя
     */
    public function check(int $sub_step_test_id, $user_answer, int $user_id, int $locale_id): SubStepContentTest
    {
        $subStepTest = SubStepTest::with('sub_step')->findOrFail($sub_step_test_id);
        $is_right = $this->checkAnswer($subStepTest->question_id, $user_answer);
        $test_result = SubStepContentTest::firstWhere('test_id', $sub_step_test_id);
        if ($test_result) {
            $test_result->is_right = $is_right;
            $test_result->user_answer = $user_answer;
            $test_result->save();
            $result = $test_result;
        } else {
            $result = SubStepContentTest::create([
               'test_id' => $sub_step_test_id,
               'user_id' => $user_id,
               'is_right' => $is_right,
               'user_answer' => $user_answer
            ]);
        }
        $this->refreshSubStepResults($subStepTest->sub_step_id, $user_id, $locale_id);
        $this->refreshStepResults($subStepTest->sub_step->step_id, $user_id, $locale_id);
        return $result;
    }

    public function refreshSubStepResults(int $sub_step_id, int $user_id, int $locale_id): void
    {
        $points = 0;
        $sub_step_tests = SubStepTest::where(['sub_step_id' => $sub_step_id, 'locale_id' => $locale_id])->get();
        foreach ($sub_step_tests as $sub_step_test) {
            $contentTest = SubStepContentTest::firstWhere('test_id', $sub_step_test->id);
            $points += $contentTest != null ? $contentTest->is_right : 0;
        }
        $stepResult = SubStepResult::firstWhere(['sub_step_id' => $sub_step_id, 'user_id' => $user_id, 'locale_id' => $locale_id]);
        $user_point = round(($points/$sub_step_tests->count()) * 100, 1);
        if ($stepResult) {
            $stepResult->user_point = $user_point;
            $stepResult->save();
        } else {
            SubStepResult::create([
               'sub_step_id' => $sub_step_id,
               'user_id' => $user_id,
               'user_point' => $user_point,
               'locale_id' => $locale_id
            ]);
        }
    }

    public function refreshStepResults(int $step_id, int $user_id, int $locale_id) : void
    {
        $user = \Auth::user();
        $sub_steps = SubStep::with('sub_result')->where('step_id', $step_id)->get();
        $user_point = 0;
        foreach ($sub_steps as $sub_step) {
            if ($sub_step->sub_result != null) {
                foreach ($sub_step->sub_result as $item) {
                    $res = $item->firstWhere('locale_id', $locale_id);
                    $user_point += $res->user_point;
                }
            }
        }
        $point = round(($user_point/($sub_steps->count()*100))*100,1);
        $test_result = StepResult::firstWhere(['step_id' => $step_id, 'user_id' => $user_id, 'locale_id' => $locale_id]);
        if ($test_result) {
            $test_result->user_point = $point;
            $test_result->save();
            if ($test_result->user_point >= 90) {
                $bonus = UserStepsBonus::firstWhere(['step_id' => $step_id, 'user_id' => $user_id]);
                if (!$bonus) {
                    UserStepsBonus::create(['step_id' => $step_id, 'user_id' => $user_id]);
                    $user->deposit(10);
                }
            }
        } else {
            StepResult::create([
                'step_id' => $step_id,
                'user_id' => $user_id,
                'user_point' => $point,
                'locale_id' => $locale_id
            ]);
        }
    }

    public function checkAnswer(int $question_id, $user_answer) : bool
    {
        $question = Question::findOrFail($question_id);
        if ($question->correct_answers == $user_answer) {
            return 1;
        } else {
            return 0;
        }
    }

    public function checkStepAccept(Step $step): bool
    {
        $subs = auth()->guard('api')->user()->activeSubscriptions();
        if ($step->is_free) {
            return true;
        } else {
            if ($subs->count()) {
                $pl = $subs->pluck('name', 'tag');
                if (isset($pl[$step->subject_id])) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}
