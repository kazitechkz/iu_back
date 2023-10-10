<?php

namespace App\Http\Controllers\Api;

use App\DTOs\AnswerDTO;
use App\DTOs\AttemptCreateDTO;
use App\DTOs\AttemptDTO;
use App\DTOs\SubjectQuestionDTO;
use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\AttemptQuestion;
use App\Models\AttemptSubject;
use App\Models\CommercialGroupPlan;
use App\Models\Question;
use App\Models\Subject;
use App\Models\UserQuestion;
use App\Services\AnswerService;
use App\Services\AttemptService;
use App\Services\QuestionService;
use App\Traits\ResponseJSON;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $attempt = $this->attemptService->create_attempt($user->id,$attempt->attempt_type_id,$attempt->locale_id,$max_points,$questions,$max_time);
        return response()->json(new ResponseJSON(status: true,data: $attempt),200);
    }



    public function attemptById($id){
        try{
            $user = auth()->guard("api")->user();
            $attempt  = Attempt::where(["end_at"=>null])->find($id);
            if(!$attempt){
                return response()->json(new ResponseJSON(status: false,message: "Not Found"),404);
            }
            if($attempt->user_id != $user->id){
                return response()->json(new ResponseJSON(status: false,message: "Forbidden"),403);
            }
            if($attempt->start_at->addMilliseconds($attempt->time) < Carbon::now()){
                $attempt->update(["end_at" => Carbon::now()]);
                return response()->json(new ResponseJSON(status: false,message: "Время уже прошло"),404);
            }
            if($attempt->start_at > Carbon::now()){
                return response()->json(new ResponseJSON(status: false,message: "Время еще не наступило"),404);
            }
            $this->answerService->check_attempt($attempt,$user->id);
            $data = $this->attemptService->get_attempt_by_id($id);
            return response()->json(new ResponseJSON(status: true,data: $data),200);
        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }
    }

    public function statAttemptById($id){
        try{
            $user = auth()->guard("api")->user();
            $attempt  = Attempt::where("end_at","!=",null)->find($id);
            if(!$attempt){
                return response()->json(new ResponseJSON(status: false,message: "Not Found"),404);
            }
            if($attempt->user_id != $user->id){
                return response()->json(new ResponseJSON(status: false,message: "Forbidden"),403);
            }
            $data = $this->attemptService->get_attempt_by_id($id,false);

            $attempt_subjects = AttemptSubject::where(["attempt_id"=>$attempt->id])->pluck("id")->toArray();
            $attempt_questions = AttemptQuestion::whereIn("attempt_subject_id",$attempt_subjects)->get();

            return response()->json(new ResponseJSON(status: true,data: ["attempt"=>$data,"attempt_questions"=>$attempt_questions,"result"=>$attempt]),200);
        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }
    }


    public function answer(Request $request){
        $answer_dto = AnswerDTO::fromRequest($request);
        $result = $this->answerService->check(
            user_id: auth()->guard("api")->id(),
            attempt_id: $answer_dto->attempt_id,
            attempt_subject_id: $answer_dto->attempt_subject_id,
            question_id: $answer_dto->question_id,
            attempt_type: $answer_dto->attempt_type_id,answers: $answer_dto->answers
        );
        return response()->json(new ResponseJSON(status: true,data: $result),200);
    }

    public function answerResult(int $attempt_subject_id){
        $user = auth()->guard("api")->user();
        $attempt_subject = AttemptSubject::where(["id"=>$attempt_subject_id])->first();

        if(!$attempt_subject){
            return response()->json(new ResponseJSON(status: false,message: "Not Found"),404);
        }
        $attempt = Attempt::where(["id"=>$attempt_subject->attempt_id])->first();
        if($attempt->user_id != $user->id){
            return response()->json(new ResponseJSON(status: false,message: "Forbidden"),403);
        }
        $result = AttemptQuestion::where(["attempt_subject_id"=>$attempt_subject_id,"is_answered"=>true])->pluck("user_answer","question_id")->toArray();
        foreach ($result as $key=>$value) {
            $result[$key] = explode(",", $value);
        }
        return response()->json(new ResponseJSON(status: true,data: $result),200);
    }

    public function userAttempts(){
        $user = auth()->guard("api")->user();
        foreach (Attempt::where(["user_id" => $user->id,"end_at" => null])->get() as $attempt){
           $time = $attempt->start_at->addMilliseconds($attempt->time);
            if($time <= Carbon::now()){
                $attempt->update(["end_at" => $time]);
                $attempt->save();
            }
            else{
                $attempt->update(['time_left'=>$attempt->time - Carbon::now()->diffInMilliseconds($attempt->start_at)]);
            }
        }
        $result = Attempt::where(["user_id" => $user->id])->orderBy("start_at","DESC")->with("attempt_type","locale","subjects")->paginate(12);
        return response()->json(new ResponseJSON(status: true,data: $result),200);
    }


    public function userUntStat(){
        $user = auth()->guard("api")->user();
        $attempt_ids = Attempt::where(["user_id" => $user->id])->pluck("id","id")->toArray();
        $attempt_count = Attempt::where(["user_id" => $user->id])->count();
        $attempt_count_unfinished = Attempt::where(["user_id" => $user->id,"end_at" => null])->count();
        $attempt_question_count  = AttemptQuestion::whereHas("attempt_subject",function($q)use($attempt_ids){
            $q->whereIn('attempt_id',$attempt_ids);
        })->pluck("question_id","question_id")->count();
        $average_unt_count = Attempt::where(["user_id" => $user->id,"type_id" => 2])->avg("points");
        $stat_by_week = Attempt::whereBetween("start_at",[Carbon::now()->addDays(-7),Carbon::now()])
            ->select(DB::raw('DATE(start_at) as date'), DB::raw('avg(points) as points'))
            ->groupBy('date')
            ->pluck("points","date")->toArray();
        $data = ["attempt_count"=>$attempt_count,"attempt_count_unfinished"=>$attempt_count_unfinished,"attempt_question_count"=>$attempt_question_count,"average"=>round($average_unt_count),"stat_by_week"=>$stat_by_week];
        return response()->json(new ResponseJSON(status: true,data: $data),200);
    }


    public function finish(int $attempt_id){
        $user = auth()->guard("api")->user();
        $attempt  = Attempt::where("end_at","!=",null)->find($attempt_id);
        if(!$attempt){
            return response()->json(new ResponseJSON(status: false,message: "Not Found"),404);
        }
        if($attempt->user_id != $user->id){
            return response()->json(new ResponseJSON(status: false,message: "Forbidden"),403);
        }
        $attempt->update(["end_at" => Carbon::now()]);
        return response()->json(new ResponseJSON(status: true,data: $attempt_id),200);
    }



}
