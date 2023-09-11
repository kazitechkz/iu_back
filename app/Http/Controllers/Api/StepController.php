<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\StepService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StepController extends Controller
{
    private StepService $stepService;

    public function __construct(StepService $stepService)
    {
        $this->stepService = $stepService;
    }

    public function getSubSteps()
    {

    }

    public function getStepTests(int $sub_step_id, int $locale_id)
    {
        $results = $this->stepService->getSubStepTests($sub_step_id, $locale_id);
        if ($results != null) {
            return response()->json(new ResponseJSON(
                status: true,
                data: $results
            ));
        } else {
            return response()->json(new ResponseJSON(
                status: false,
                errors: "Недостаточно прав!"
            ));
        }
    }

    public function passTest(Request $request)
    {
        try {
            $this->validate($request, [
                'sub_step_id' => 'required|exists:sub_step_tests,id',
                'user_answer' => 'required'
            ]);
            return response()->json(new ResponseJSON(
                status: true,
                data: $this->stepService->check($request['sub_step_id'], $request['user_answer'], auth()->id())
            ));
        } catch (ValidationException $exception) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $exception->errors()
            ));
        }
    }
}
