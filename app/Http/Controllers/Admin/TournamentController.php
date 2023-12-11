<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tournament\TournamentCreateRequest;
use App\Http\Requests\Tournament\TournamentUpdateRequest;
use App\Models\News;
use App\Models\Tournament;
use App\Models\TournamentLocale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("tournament index") ){
                return view("admin.tournament.index");
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
                return view("admin.tournament.create");
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
    public function store(TournamentCreateRequest $request)
    {
        try{
            if(auth()->user()->can("tournament create") ){
                $input = $request->all();
                $input["start_at"] = Carbon::parse($input["start_at"]);
                $input["end_at"] = Carbon::parse($input["end_at"]);
                $tournament = Tournament::add($input);
                foreach ($request->get("locale_id") as $locale_id){
                    TournamentLocale::add(["tournament_id"=>$tournament->id,"locale_id"=>$locale_id]);
                }
                return redirect()->route("tournament.index");
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
        try{
            if(auth()->user()->can("tournament show") ){
                $tournament = Tournament::find($id);
                if($tournament){
                    return view("admin.tournament.show",compact("tournament"));
                }
                return redirect()->route("tournament.index");
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            if(auth()->user()->can("tournament edit") ){
                $tournament = Tournament::find($id);
                if($tournament){
                    return view("admin.tournament.edit",compact("tournament"));
                }
                return redirect()->route("tournament.index");
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
    public function update(TournamentUpdateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("tournament edit") ){
                $tournament = Tournament::find($id);
                if($tournament){
                    $input = $request->all();
                    $input["start_at"] = Carbon::parse($input["start_at"]);
                    $input["end_at"] = Carbon::parse($input["end_at"]);
                    $tournament->edit($input);
                }
                return redirect()->route("tournament.index");
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
