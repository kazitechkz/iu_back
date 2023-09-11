<?php

namespace App\Http\Controllers\Api;

use App\DTOs\AnswerDTO;
use App\DTOs\AttemptCreateDTO;
use App\DTOs\AttemptDTO;
use App\DTOs\SubjectQuestionDTO;
use App\Http\Controllers\Controller;
use App\Models\AttemptQuestion;
use App\Models\Subject;
use App\Services\AnswerService;
use App\Services\AttemptService;
use App\Services\QuestionService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class AttemptController extends Controller
{
    private readonly AttemptService $attemptService;
    private readonly QuestionService $questionService;
    private readonly AnswerService $answerService;

    public function __construct(AttemptService $attemptService,QuestionService $questionService,AnswerService $answerService)
    {
        $this->attemptService = $attemptService;
        $this->questionService = $questionService;
        $this->answerService = $answerService;
    }



    public function attempt(Request $request){
        $attempt = AttemptCreateDTO::fromRequest($request);
        $user = auth()->guard("api")->user();
        $questions = $this->questionService->get_questions_with_subjects($attempt->subjects,$attempt->locale_id,$attempt->attempt_type_id);
        $max_points = $this->questionService->get_questions_max_point($questions);
        $max_time = $this->questionService->get_max_time_in_ms($questions);
        $attempt = $this->attemptService->create_attempt(auth()->id(),$attempt->attempt_type_id,$attempt->locale_id,$max_points,$questions,$max_time);
        return response()->json(new ResponseJSON(status: true,data: $attempt),200);
    }

    public function answer(Request $request){
        $answer_dto = AnswerDTO::fromRequest($request);
        $result = $this->answerService->check(
            user_id: auth()->id(),
            attempt_id: $answer_dto->attempt_id,
            attempt_subject_id: $answer_dto->attempt_subject_id,
            question_id: $answer_dto->question_id,
            attempt_type: $answer_dto->attempt_type_id,answers: $answer_dto->answers
        );
        return response()->json(new ResponseJSON(status: true,data: $result),200);


    }



}
