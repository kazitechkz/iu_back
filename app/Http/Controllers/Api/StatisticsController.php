<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AttemptService;
use App\Services\ResponseService;
use App\Services\StatisticsService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    private readonly StatisticsService $_statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->_statisticsService = $statisticsService;
    }
    public function resultByAttemptId($attempt_id){
        try{
            $result = $this->_statisticsService->getResultByAttemptId($attempt_id);
            return response()->json(new ResponseJSON(status: true,data: $result),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function statsByAttemptId($attempt_id){
        try{
            $result = $this->_statisticsService->getStatByAttemptId($attempt_id);
            return response()->json(new ResponseJSON(status: true,data: $result),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function statsBySubjectId($subject_id){
        try{
            $result = $this->_statisticsService->getStatBySubjectId($subject_id);
            return response()->json(new ResponseJSON(status: true,data: $result),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
