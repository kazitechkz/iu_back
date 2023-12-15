<?php

namespace App\Http\Controllers\Api;

use App\DTOs\AnswerBattleQuestion;
use App\DTOs\BattleCreateDTO;
use App\DTOs\BattleStepCreateDTO;
use App\Http\Controllers\Controller;
use App\Models\Battle;
use App\Models\BattleStep;
use App\Models\BattleStepQuestion;
use App\Models\Subject;
use App\Services\BattleService;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class BattleController extends Controller
{
    private readonly BattleService $battleService;

    public function __construct(BattleService $service){
        $this->battleService = $service;
    }

    public function getBattleByPromo(Request $request){
        try {
            $battle = Battle::where(["promo_code" => $request->get("promo_code")])->with(
                ["owner","guest","winner","locale","battle_steps.battle_step_results","battle_steps.battle_step_questions"]
            )->first();
            $user = auth()->guard("api")->user();
            if(!$battle){
                return ResponseService::NotFound("Игра не найдена!");
            }
            if($battle->owner_id == $user->id || $battle->guest_id == $user->id){
                return response()->json(new ResponseJSON(status: true, data: $battle), 200);
            }
            return ResponseService::NotFound("Игра не найдена!");
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }


    public function createBattle(Request $request){
        try {
            $request = BattleCreateDTO::fromRequest($request);
            $result = $this->battleService->createBattle($request);
            $result->load(["battle_steps.battle_step_results",'battle_steps.battle_step_questions',"locale"]);
            return response()->json(new ResponseJSON(status: true, data: $result), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function proposeSubjects(){
        try {
            $result = Subject::inRandomOrder()->take(3)->with("image")->get();
            return response()->json(new ResponseJSON(status: true, data: $result), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function createBattleStep(Request $request){
        try {
            $request = BattleStepCreateDTO::fromRequest($request);
            $result = $this->battleService->createBattleStep($request);
            return response()->json(new ResponseJSON(status: true, data: $result), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function getBattleStepById($battle_step_id){
        try {
            $user = auth()->guard("api")->user();
            $battleStep = BattleStep::where(["id"=>$battle_step_id,"current_user" => $user->id,'is_current' => true,"is_finished" => false])->first();
            if(!$battleStep){
                return ResponseService::NotFound("Не найден этап игры");
            }
            $questions = BattleStepQuestion::where(["step_id" => $battle_step_id,"user_id"=>$user->id])->pluck("question_id","question_id")->toArray();
            $result = BattleService::getBattleStepQuestions(questions:$questions,battleStep: $battleStep,user: $user);
            return response()->json(new ResponseJSON(status: true, data: $result), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function answerQuestion(Request $request){
        try {
            $request = AnswerBattleQuestion::fromRequest($request);
            $this->battleService->checkAnswer($request);
            return response()->json(new ResponseJSON(status: true, data: null), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function joinToBattleByPromoCode(Request $request){
        try {
            $user = auth()->guard("api")->user();
            $promo_code = $request["promo_code"];
            $battle = Battle::where(["promo_code" => $promo_code,"is_open" => true])->with(
                ["owner","guest","winner","locale","battle_steps.battle_step_results","battle_steps.battle_step_questions"]
            )->first();
            if(!$battle){
                return ResponseService::ValidationException("Игра не найдена!");
            }
            if($battle->pass_code){
                if(!\Hash::check($request->get("pass_code"),$battle->pass_code)){
                    return ResponseService::ValidationException("Неверный пароль для игры!");
                }
            }
            $this->battleService->joinToBattle($battle);
            return response()->json(new ResponseJSON(status: true, data: $battle), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

}
