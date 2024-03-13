<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubTournament;
use App\Models\SubTournamentParticipant;
use App\Models\SubTournamentResult;
use App\Models\Tournament;
use App\Models\TournamentWinner;
use App\Services\TournamentService;
use Illuminate\Http\Request;

class TournamentAwardController extends Controller
{
    public function show($id){
        $tournament = Tournament::with("sub_tournaments")->find($id);
        //Sub Steps
        $final_sub = $tournament->sub_tournaments()->where(["step_id"=>4])->first();
        $half_final_sub = $tournament->sub_tournaments()->where(["step_id"=>3])->first();
        $fourth_final_sub = $tournament->sub_tournaments()->where(["step_id"=>2])->first();
        $first_sub = $tournament->sub_tournaments()->where(["step_id"=>1])->first();

        $winner = TournamentWinner::where(["tournament_id" => $tournament->id])->first();
        $second_winner = SubTournamentParticipant::where(["sub_tournament_id" => $final_sub->id])->where("user_id","!=",$winner->winner_id)->first();
        $third_winners = SubTournamentParticipant::where(["sub_tournament_id" => $half_final_sub->id])->whereNotIn("user_id",[$winner->winner_id,$second_winner->user_id])->pluck("user_id")->toArray();
        $fourth_winners = SubTournamentParticipant::where(["sub_tournament_id" => $fourth_final_sub->id])->whereNotIn("user_id",[$winner->winner_id,$second_winner->user_id,...$third_winners])->pluck("user_id")->toArray();

        dump($winner->winner_id);
        dump($second_winner->user_id);
        dump($third_winners);
        dump($fourth_winners);
        dd(123);
        $five_to_twenty = SubTournamentResult::
                where(["sub_tournament_id" => $first_sub->id])
                ->whereNot("user_id",[$winner->winner_id,$second_winner->user_id,...$third_winners,...$fourth_winners])
                ->orderBy("point","DESC")->orderBy("time","DESC")->take(20);


    }
}
