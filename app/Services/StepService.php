<?php

namespace App\Services;

use App\Models\SubStepTest;

class StepService
{
    /**
     * @param int $sub_step_id = SubStepId айди Субраздела
     * @return void
     */
    public function getSubStepTests(int $sub_step_id)
    {
        return SubStepTest::where(['sub_step_id' => $sub_step_id])->with('sub_question')->get();
    }

    /**
     * @param int $sub_step_test_id = SubStepTestId айди вопроса
     * @param $user_answer = UserAnswer ответ пользователя
     * @param $user_id = UserId айди пользователя
     * @return void
     */
    public function check(int $sub_step_test_id, $user_answer, int $user_id)
    {
//        $subStepTest = SubStepTest::find
    }
}
