<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TournamentPrize\TournamentPrizeCreateRequest;
use App\Http\Requests\TournamentPrize\TournamentPrizeEditRequest;
use App\Models\TournamentPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TournamentPrizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("tournament index") ){
                return view("admin.tournament-prize.index");
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            if(auth()->user()->can("tournament create") ){
                return view("admin.tournament-prize.create");
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TournamentPrizeCreateRequest $request)
    {
        try{
            if(auth()->user()->can("tournament create") ){
                $input = $request->all();
                $input["is_virtual"] = $request->boolean("is_virtual");
                TournamentPrize::add($input);
                return redirect()->route("tournament-prize.index");
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            if(auth()->user()->can("tournament show") ){
                $tournamentPrize = TournamentPrize::find($id);
                if($tournamentPrize){
                    return view("admin.tournament-prize.edit",compact("tournamentPrize"));
                }
                toastr()->warning("Не найден");
                return redirect()->route("tournament-prize.index");
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TournamentPrizeEditRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("tournament edit") ){
                $tournamentPrize = TournamentPrize::find($id);
                if($tournamentPrize){
                    $input = $request->all();
                    $input["is_virtual"] = $request->boolean("is_virtual");
                    $tournamentPrize->edit($input);
                }
                return redirect()->route("tournament-prize.index");
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            if(auth()->user()->can("tournament edit") ){
                $tournamentPrize = TournamentPrize::find($id);
                if($tournamentPrize){
                    $tournamentPrize->delete();
                }
                return redirect()->route("home");
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }
}
