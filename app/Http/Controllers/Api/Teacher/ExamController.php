<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AttemptSetting;
use App\Models\AttemptSettingsResult;
use App\Traits\ResponseJSON;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ExamController extends Controller
{
    public function getMyTests()
    {
        try {
            $exams = AttemptSetting::where('owner_id', auth()->guard('api')->id())->get();
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
}
