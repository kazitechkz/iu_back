<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubTournament;
use App\Models\SubTournamentParticipant;
use App\Models\SubTournamentResult;
use App\Models\Tournament;
use App\Models\TournamentAward;
use App\Models\TournamentPrize;
use App\Models\TournamentWinner;
use App\Models\User;
use App\Services\TournamentService;
use Illuminate\Http\Request;

class TournamentAwardController extends Controller
{
    public function show($id){
        if($tournament = Tournament::find($id)){
            if(TournamentAward::where(["tournament_id" => $id])->first()){
                toastr()->warning("Подарки уже распределены");
            }
            else{
                $tournamentWinner = TournamentWinner::where(["tournament_id"=>$id])->first();
                if($tournamentWinner){
                    $tournamentService = new TournamentService();
                    $tournamentService->givePrize($id);
                    toastr()->success("Призы успешно разданы");
                }
                else{
                    toastr()->warning("Победитель еще не определен");
                }
            }
        }
        else{
            toastr()->warning("Турнир не найден");
        }
        return redirect()->back();
    }

    public function index(){
        return view("admin.tournament-award.index");
    }
}
