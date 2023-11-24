<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\AttemptSetting;
use App\Models\AttemptSettingsUnt;
use App\Models\ClassroomGroup;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $userID = auth()->guard('api')->id();
            $data = [];
            $classrooms = ClassroomGroup::with('classrooms')->where('teacher_id', $userID)->get()->pluck('classrooms.student_id');
//            $data['classrooms'] = $classrooms->count();
//            $data['users'] = 0;
//            foreach ($classrooms as $classroom) {
//                $data['users'] += $classroom->classrooms_count;
//            }
//            $single_tests = AttemptSetting::where('owner_id', $userID)->get();
//            $data['single_tests'] = $single_tests->count();
//            $data['unt_tests'] = AttemptSettingsUnt::where('sender_id', $userID)->count();
//            $top_single_results = Attempt::where('type_id', 4)->whereIn();
            dd($classrooms);

            return response()->json(new ResponseJSON(status: true, data: $data));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
