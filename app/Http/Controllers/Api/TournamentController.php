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
use App\Models\TournamentStep;
use App\Services\AnswerService;
use App\Services\AttemptService;
use App\Services\QuestionService;
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
        $user = auth()->guard("api")->user();
        $sub_tournament_ids = SubTournamentParticipant::where(["user_id"=>$user->id])->pluck("sub_tournament_id","sub_tournament_id")->toArray();
        $tournament_ids = SubTournament::whereIn("id",$sub_tournament_ids)->pluck("tournament_id","tournament_id")->toArray();
        $open_tournaments = Tournament::
            where(["status"=>1])
            ->where("start_at","<",Carbon::now())
            ->where("end_at",">",Carbon::now())
            ->with(["locales","subject","file"])
            ->get();
        $participated_tournaments = Tournament::whereIn("id",$tournament_ids)->with(["locales","subject","file"])->get();
        return response()->json(new ResponseJSON(status: true,data: ["open"=>$open_tournaments,"participated"=>$participated_tournaments,"tournament_ids"=>$tournament_ids]),200);
    }


    public function tournamentDetail($id){
        $user = auth()->guard("api")->user();
        $tournament = Tournament::with(["locales","subject","file","sub_tournaments.tournament_step"])->firstWhere(["id"=>$id]);
        if ($tournament){
            $steps = TournamentStep::all();
            $sub_tournament_ids = SubTournamentParticipant::where(["user_id"=>$user->id])->pluck("sub_tournament_id")->toArray();
            $tournament_ids = SubTournament::whereIn("id",$sub_tournament_ids)->pluck("tournament_id")->toArray();
            $data = ["tournament"=>$tournament,"subtournament_ids"=>$sub_tournament_ids,"tournament_ids"=>$tournament_ids,"steps"=>$steps];
            return response()->json(new ResponseJSON(status: true,data: $data),200);
        }
        return response()->json(new ResponseJSON(status: false,message: "Tournament Not Found"),404);
    }

    public function subTournamentDetail($id){
        $user = auth()->guard("api")->user();
        $sub_tournament = SubTournament::with("tournament_step")->firstWhere(["id"=>$id]);
        if(!$sub_tournament){
            return response()->json(new ResponseJSON(status: false,message: "Этапа не существует"),404);
        }
        $sub_tournament_ids = SubTournamentParticipant::where(["user_id"=>$user->id])->pluck("sub_tournament_id")->toArray();
        $tournament = Tournament::with(["locales","subject","file"])->firstWhere(["id"=>$sub_tournament->tournament_id]);
        $data = ["tournament"=>$tournament,"subtournament_ids"=>$sub_tournament_ids,"sub_tournament"=>$sub_tournament];
        return response()->json(new ResponseJSON(status: true,data: $data),200);
    }
    public function subTournamentWinners($id){
        $user = auth()->guard("api")->user();
        $sub_tournament = SubTournament::with("tournament_step")->firstWhere(["id"=>$id]);
        if(!$sub_tournament){
            return response()->json(new ResponseJSON(status: false,message: "Этапа не существует"),404);
        }
        $sub_tournament_winner = null;
        $my_result = null;
        if($sub_tournament->is_finished){
            $sub_tournament_winner = SubTournamentWinner::where(["sub_tournament_id" => $sub_tournament->id])->with(['user'])->paginate(20);
        }
        return response()->json(new ResponseJSON(status: true,data: $sub_tournament_winner),200);
    }

    public function subTournamentRival($id){
        $sub_tournament = SubTournament::with("tournament_step")->firstWhere(["id"=>$id]);
        if(!$sub_tournament){
            return response()->json(new ResponseJSON(status: false,message: "Этапа не существует"),404);
        }
        $sub_tournament_rivals = SubTournamentRival::where(["sub_tournament_id" => $sub_tournament->id])
            ->with(["sub_tournament","winner_user","rival_one_user","rival_two_user"])
            ->get();
        return response()->json(new ResponseJSON(status: true,data: $sub_tournament_rivals),200);
    }

    public function subTournamentResult($id){
        $user = auth()->guard("api")->user();
        $sub_tournament = SubTournament::with("tournament_step")->firstWhere(["id"=>$id]);
        if(!$sub_tournament){
            return response()->json(new ResponseJSON(status: false,message: "Этапа не существует"),404);
        }
        $sub_tournament_result = null;
        $my_result = null;
        if($sub_tournament->is_finished){
            $sub_tournament_result = SubTournamentResult::where(["sub_tournament_id" => $sub_tournament->id])->with(["user"])->paginate(20);
            $my_result = SubTournamentResult::where(["sub_tournament_id" => $sub_tournament->id,"user_id" => $user->id])->with(["user"])->first();
        }
        $data = ["results"=>$sub_tournament_result,"my_result"=>$my_result];
        return response()->json(new ResponseJSON(status: true,data: $data),200);
    }
    public function subTournamentParticipants($id){
        $user = auth()->guard("api")->user();
        $sub_tournament = SubTournament::with("tournament_step")->firstWhere(["id"=>$id]);
        if(!$sub_tournament){
            return response()->json(new ResponseJSON(status: false,message: "Этапа не существует"),404);
        }
        $participants = SubTournamentParticipant::with(["user"])->where(["sub_tournament_id" => $sub_tournament->id])->paginate(20);
        return response()->json(new ResponseJSON(status: true,data: $participants),200);
    }

    public function attempt(Request $request){
        $attempt_tournament = SubTournamentCreateDTO::fromRequest($request);
        $user = auth()->guard("api")->user();
        $attempt = $this->tournamentService->get_questions(user_id: $user->id,sub_tournament_id: $attempt_tournament->sub_tournament_id,locale_id: $attempt_tournament->locale_id);
        return response()->json(new ResponseJSON(status: true,data: $attempt),200);
    }


    public function participate(Request $request){
        $attempt_tournament = SubTournamentCreateDTO::fromRequest($request);
        $this->tournamentService->participate(auth()->guard("api")->id(),$attempt_tournament->sub_tournament_id);
        return response()->json(new ResponseJSON(status: true,data: true),200);

    }



}
