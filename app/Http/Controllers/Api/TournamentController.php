<?php

namespace App\Http\Controllers\Api;

use App\DTOs\AttemptCreateDTO;
use App\DTOs\SubTournamentCreateDTO;
use App\Http\Controllers\Controller;
use App\Models\SubTournament;
use App\Models\SubTournamentParticipant;
use App\Models\Tournament;
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
            where("status","==",1)
            ->with(["locales","subject","file"])
            ->get();
        $participated_tournaments = Tournament::whereIn("id",$tournament_ids)->with(["locales","subject","file"])->get();
        return response()->json(new ResponseJSON(status: true,data: ["open"=>$open_tournaments,"participated"=>$participated_tournaments,"tournament_ids"=>$tournament_ids]),200);
    }

    public function attempt(Request $request){
        $attempt_tournament = SubTournamentCreateDTO::fromRequest($request);
        $user = auth()->guard("api")->user();
        $attempt = $this->tournamentService->get_questions(user_id: auth()->id(),sub_tournament_id: $attempt_tournament->sub_tournament_id,locale_id: $attempt_tournament->locale_id);
        return response()->json(new ResponseJSON(status: true,data: $attempt),200);
    }


    public function participate(Request $request){
        $attempt_tournament = SubTournamentCreateDTO::fromRequest($request);
        $this->tournamentService->participate(auth()->id(),$attempt_tournament->sub_tournament_id);
        return response()->json(new ResponseJSON(status: true,data: true),200);

    }



}
