<?php

namespace App\Http\Controllers\Api;

use App\DTOs\AttemptCreateDTO;
use App\DTOs\SubTournamentCreateDTO;
use App\Http\Controllers\Controller;
use App\Models\Step;
use App\Models\SubTournament;
use App\Models\SubTournamentParticipant;
use App\Models\SubTournamentResult;
use App\Models\SubTournamentRival;
use App\Models\SubTournamentWinner;
use App\Models\Tournament;
use App\Models\TournamentAward;
use App\Models\TournamentStep;
use App\Services\AnswerService;
use App\Services\AttemptService;
use App\Services\QuestionService;
use App\Services\ResponseService;
use App\Services\TournamentService;
use App\Traits\ResponseJSON;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    private readonly AttemptService $attemptService;
    private readonly QuestionService $questionService;
    private readonly AnswerService $answerService;
    private readonly TournamentService $tournamentService;

    public function __construct(AttemptService $attemptService,QuestionService $questionService,AnswerService $answerService,TournamentService $tournamentService)
    {
        $this->attemptService = $attemptService;
        $this->questionService = $questionService;
        $this->answerService = $answerService;
        $this->tournamentService = $tournamentService;
    }



    public function getAllTournaments(){
        try{
            $user = auth()->guard("api")->user();
            $sub_tournament_ids = SubTournamentParticipant::where(["user_id"=>$user->id])->pluck("sub_tournament_id","sub_tournament_id")->toArray();
            $tournament_ids = SubTournament::whereIn("id",$sub_tournament_ids)->pluck("tournament_id","tournament_id")->toArray();
            $open_tournaments = Tournament::
            where(["status"=>1])
//                ->where("start_at","<",Carbon::now())
//                ->where("end_at",">",Carbon::now())
                ->with(["locales","subject","file"])
                ->latest()
                ->get();
            $participated_tournaments = Tournament::whereIn("id",$tournament_ids)->with(["locales","subject","file"])->get();
            return response()->json(new ResponseJSON(status: true,data: ["open"=>$open_tournaments,"participated"=>$participated_tournaments,"tournament_ids"=>$tournament_ids]),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }


    public function tournamentDetail($id)
    {
        try {
            $user = auth()->guard("api")->user();
            $tournament = Tournament::with([
                "locales",
                "subject",
                "file",
                "sub_tournaments.tournament_step"
            ])->firstWhere(["id" => $id]);
            if ($tournament) {
                $currentST = false;
                $firstST = false;
                $steps = TournamentStep::all();
//                $sub_tournament_ids = SubTournamentParticipant::where(["user_id"=>$user->id])->pluck("sub_tournament_id")->toArray();
//                $tournament_ids = SubTournament::whereIn("id",$sub_tournament_ids)->pluck("tournament_id")->toArray();
                if ($tournament->currentSubTournament()) {
                    $currentST = (bool)$tournament->currentSubTournament()->subtournament_participants()->where('user_id', $user->id)->first();
                }
                if ($tournament->firstSubTournament()) {
                    $firstST = (bool)$tournament->firstSubTournament()->subtournament_participants()->where('user_id', $user->id)->first();
                }
                $data = [
                    'is_join' => $currentST,
                    'is_reg' => $firstST,
                    "tournament" => $tournament,
                    "steps" => $steps,
                    'firstSubTournament' => $tournament->firstSubTournament(),
                    'currentSubTournament' => $tournament->currentSubTournament(),
                    'check_access' => $tournament->check_access(),
                    'winner_tournament' => $tournament->winnerTournament()
                ];

                return response()->json(new ResponseJSON(status: true, data: $data));
            }
            return response()->json(new ResponseJSON(status: false, message: "Tournament Not Found"), 404);
        } catch (\Exception $exception) {
            dd($exception);
            return ResponseService::DefineException($exception);
        }
    }

    public function subTournamentDetail($id){
        try{
            $user = auth()->guard("api")->user();
            $sub_tournament = SubTournament::with("tournament_step")->firstWhere(["id"=>$id]);
            if(!$sub_tournament){
                return response()->json(new ResponseJSON(status: false,message: "Этапа не существует"),404);
            }
            $sub_tournament_ids = SubTournamentParticipant::where(["user_id"=>$user->id])->pluck("sub_tournament_id")->toArray();
            $tournament = Tournament::with(["locales","subject","file"])->firstWhere(["id"=>$sub_tournament->tournament_id]);
            $my_result = SubTournamentResult::where(["sub_tournament_id" => $sub_tournament->id,"user_id" => $user->id])->with(["user"])->first();
            $data = ["tournament"=>$tournament,"sub_tournament_ids"=>$sub_tournament_ids,"sub_tournament"=>$sub_tournament,"my_result"=>$my_result];
            return response()->json(new ResponseJSON(status: true,data: $data),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }

    }
    public function subTournamentWinners($id){
        try{
            $user = auth()->guard("api")->user();
            $sub_tournament = SubTournament::with("tournament_step")->firstWhere(["id"=>$id]);
            if(!$sub_tournament){
                return response()->json(new ResponseJSON(status: false,message: "Этапа не существует"),404);
            }
            $sub_tournament_winners = null;
            if($sub_tournament->is_finished){
                $sub_tournament_winners = SubTournamentWinner::where(["sub_tournament_id" => $sub_tournament->id])->with(['user'])->get();
            }
            return response()->json(new ResponseJSON(status: true,data: $sub_tournament_winners),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }

    }

    public function subTournamentRival($id){
        try{
            $sub_tournament = SubTournament::with("tournament_step")->firstWhere(["id"=>$id]);
            if(!$sub_tournament){
                return response()->json(new ResponseJSON(status: false,message: "Этапа не существует"),404);
            }
            $sub_tournament_rivals = SubTournamentRival::where(["sub_tournament_id" => $sub_tournament->id])
                ->with(["sub_tournament","winner_user","rival_one_user","rival_two_user"])
                ->get();
            return response()->json(new ResponseJSON(status: true,data: $sub_tournament_rivals),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }

    }

    public function subTournamentResult($id){
        try {
            $user = auth()->guard("api")->user();
            $sub_tournament = SubTournament::with("tournament_step")->firstWhere(["id"=>$id]);
            if(!$sub_tournament){
                return response()->json(new ResponseJSON(status: false,message: "Этапа не существует"),404);
            }
            $sub_tournament_result = null;
            $my_result = SubTournamentResult::where(["sub_tournament_id" => $sub_tournament->id,"user_id" => $user->id])->with(["user"])->first();
//            if($sub_tournament->is_finished){
                $sub_tournament_result = SubTournamentResult::where(["sub_tournament_id" => $sub_tournament->id])->orderBy("point","DESC")->orderBy("time","DESC")->with(["user", 'sub_tournament'])->paginate(20);
//            }
            $data = ["results"=>$sub_tournament_result,"my_result"=>$my_result];
            return response()->json(new ResponseJSON(status: true,data: $data),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function subTournamentParticipants($id){
        try{
            $user = auth()->guard("api")->user();
            $sub_tournament = SubTournament::with("tournament_step")->firstWhere(["id"=>$id]);
//            if(!$sub_tournament){
//                return response()->json(new ResponseJSON(status: false,message: "Этапа не существует"),404);
//            }
            if ($sub_tournament) {
                $participants = SubTournamentParticipant::with(["user"])->where(["sub_tournament_id" => $sub_tournament->id])->latest()->paginate(20);
            } else {
                $participants = [];
            }
            return response()->json(new ResponseJSON(status: true,data: $participants));
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }

    }

    public function attempt(Request $request){
        try{
            $attempt_tournament = SubTournamentCreateDTO::fromRequest($request);
            $user = auth()->guard("api")->user();
            $attempt = $this->tournamentService->get_questions(user_id: $user->id,sub_tournament_id: $attempt_tournament->sub_tournament_id,locale_id: $attempt_tournament->locale_id);
            return response()->json(new ResponseJSON(status: true,data: $attempt),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }

    }


    public function participate(Request $request){
        try {
            $attempt_tournament = SubTournamentCreateDTO::fromRequest($request);
            $this->tournamentService->participate(auth()->guard("api")->id(),$attempt_tournament->sub_tournament_id);
            return response()->json(new ResponseJSON(status: true,data: true),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function tournamentAward($id){
        try {
            $tournamentAwards = TournamentAward::where(["tournament_id" => $id])->with(["user"])->orderBy("order","ASC")->paginate(20);
            return response()->json(new ResponseJSON(status: true,data: $tournamentAwards),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function tournamentList(){
        try{
            $tournaments = Tournament::where(["status"=>1])->with(["locales","subject","file"])->latest()->paginate(12);
            return response()->json(new ResponseJSON(status: true,data: $tournaments),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }

    }



}
