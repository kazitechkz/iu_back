<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\AttemptSetting;
use App\Models\AttemptSettingsResult;
use App\Models\AttemptSettingsUnt;
use App\Models\Classroom;
use App\Models\ClassroomGroup;
use App\Models\User;
use App\Services\ResponseService;
use App\Services\TeacherDashboardService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class DashboardController extends Controller
{
    private TeacherDashboardService $service;

    public function __construct(TeacherDashboardService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $userID = auth()->guard('api')->id();
            $data = [];
            $classrooms = ClassroomGroup::withCount('classrooms')->where('teacher_id', $userID)->get();
            $attemptSettings = AttemptSetting::where(['owner_id' => auth()->guard('api')->id()]);
            $attemptSettingsUNT = AttemptSettingsUnt::where('sender_id', $userID)->get();
            $data['single_tests'] = $attemptSettings->count();
            $data['classrooms'] = $classrooms->count();
            $data['users'] = 0;
            foreach ($classrooms as $classroom) {
                $data['users'] += $classroom->classrooms_count;
            }
            $data['unt_tests'] = $attemptSettingsUNT->count();
            $data['top_single_users'] = $this->service->getTopSingleTestUsers($attemptSettings);
            $data['top_unt_users'] = $this->service->getTopUNTTestUsers($attemptSettingsUNT);
            return response()->json(new ResponseJSON(status: true, data: $data));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function getStatsBySubjectID(Request $request)
    {
        try {
            if ($request['subject_id'] != 0) {
                $querySt = AttemptSetting::where(['subject_id' => $request['subject_id'], 'owner_id' => auth()->guard('api')->id()]);
            } else {
                $querySt = AttemptSetting::where('owner_id', auth()->guard('api')->id());
            }
            $query = $this->service->getByDate($querySt, $request);
            $attemptSettings = $query->get();
            $data = $this->service->getTopSingleTestUsers($attemptSettings);
            return response()->json(new ResponseJSON(status: true, data: $data));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function getStatsByUNT(Request $request)
    {
        try {
            $querySt = AttemptSettingsUnt::where('sender_id', auth()->guard('api')->id());
            $query = $this->service->getByDate($querySt, $request);
            $attemptSettingsUNT = $query->get();
            $data = $this->service->getTopUNTTestUsers($attemptSettingsUNT);
            return response()->json(new ResponseJSON(status: true, data: $data));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }


}
