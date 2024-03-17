<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OpenAiQuestion;
use App\Services\OpenAiService;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Exception;
use Illuminate\Http\Request;

class OpenAiController extends Controller
{
    private readonly OpenAiService $openAiService;

    public function __construct(OpenAiService $_openAiService)
    {
        $this->openAiService = $_openAiService;
    }


    public function getOpenAiAnswer(Request $request,$questionId)
    {
        try {
            $user = auth()->guard("api")->user();
            if($request->get("status") == "old" && $oldQuestion = OpenAiQuestion::where(["question_id" => $questionId])->first()){
                $answer = $oldQuestion->answer;
            }
            else{
                $this->openAiService->checkPermissionToAI($user);
                $answer = $this->openAiService->getQuestionRightAnswerAndExplanation($questionId,$user);
            }
            return response()->json(new ResponseJSON(status: true,data: $answer),200);
        }
        catch (Exception $exception){
            return ResponseService::DefineException($exception);
        }
    }
}
