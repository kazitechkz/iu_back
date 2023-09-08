<?php

namespace App\Services;

use App\Models\Question;
use App\Models\Step;
use App\Models\SubStepContentTest;
use App\Models\SubStepResult;
use App\Models\SubStepTest;

class StepService
{
    /**
     * @param int $sub_step_id = SubStepId айди Субраздела
     */
    public function getSubStepTests(int $sub_step_id, int $locale_id)
    {
        return SubStepTest::with(['question' => function($query) use ($locale_id) {
            $query->where(['locale_id' => $locale_id]);
        } ])->where(['sub_step_id' => $sub_step_id])->get();
    }

    /**
     * @param int $sub_step_test_id = SubStepTestId айди вопроса
     * @param $user_answer = UserAnswer ответ пользователя
     * @param int $user_id = UserId айди пользователя
     */
    public function check(int $sub_step_test_id, $user_answer, int $user_id): SubStepContentTest
    {
        $subStepTest = SubStepTest::findOrFail($sub_step_test_id);
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

        $this->refreshSubStepResults($subStepTest->sub_step_id, $user_id);
        return $result;
    }

    public function refreshSubStepResults(int $sub_step_id, int $user_id): void
    {
        $points = 0;
        $sub_step_tests = SubStepTest::where('sub_step_id', $sub_step_id)->get();
        foreach ($sub_step_tests as $sub_step_test) {
            $contentTest = SubStepContentTest::firstWhere('test_id', $sub_step_test->id);
            $points += $contentTest != null ? $contentTest->is_right : 0;
        }
        $stepResult = SubStepResult::firstWhere(['sub_step_id' => $sub_step_id, 'user_id' => $user_id]);
        $user_point = round(($points/$sub_step_tests->count()) * 100, 1);
        if ($stepResult) {
            $stepResult->user_point = $user_point;
            $stepResult->save();
        } else {
            SubStepResult::create([
               'sub_step_id' => $sub_step_id,
               'user_id' => $user_id,
               'user_point' => $user_point
            ]);
        }
    }

    public function refreshStepResults()
    {
//        $step_result =
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
}
