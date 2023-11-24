<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AttemptSetting;
use App\Models\AttemptSettingsResult;
use App\Models\AttemptSettingsUnt;
use App\Services\ResponseService;
use App\Services\StatisticsService;
use App\Traits\ResponseJSON;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ExamController extends Controller
{
    private readonly StatisticsService $_statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->_statisticsService = $statisticsService;
    }

    public function getSingleTestByID($id)
    {
        try {
            $exams = AttemptSetting::with('attempt_settings_results.attempt', 'attempt_settings_results.user')->where('id', $id)->first();
            $exams['attempt_users'] = $exams->getUsers($id);
            return response()->json(new ResponseJSON(
                status: true,
                data: $exams
            ));
        } catch (ValidationException $exception) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $exception->errors()
            ), 400);
        }
    }
    public function getUNTTestByID($id)
    {
        try {
            $exams = AttemptSettingsUnt::with('attempt_settings_results_unt.attempt', 'attempt_settings_results_unt.user')->where('id', $id)->first();
            $exams['attempt_users'] = $exams->getUsers($id);
            return response()->json(new ResponseJSON(
                status: true,
                data: $exams
            ));
        } catch (ValidationException $exception) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $exception->errors()
            ), 400);
        }
    }

    public function statsByAttemptId($attempt_id, $user_id)
    {
        try {
            $result = $this->_statisticsService->getStatByAttemptIdForTeacher($attempt_id, $user_id);
            return response()->json(new ResponseJSON(status: true, data: $result));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
