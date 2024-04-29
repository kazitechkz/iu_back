<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Services\ResponseService;
use App\Services\SurveyService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    private SurveyService $surveyService;

    /**
     * @param SurveyService $surveyService
     */
    public function __construct(SurveyService $surveyService)
    {
        $this->surveyService = $surveyService;
    }

    public function getSurveys($localeID)
    {
        try {
            $data = $this->surveyService->getActiveSurveys($localeID);
            return response()->json(new ResponseJSON(status: true, data: $data));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function answerSurveys(Request $request)
    {
        try {
            $this->validate($request, [
               'survey_id' => 'required|exists:surveys,id'
            ]);
            $this->surveyService->postAnswerSurveys($request->all());
            return response()->json(new ResponseJSON(status: true, data: true));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
