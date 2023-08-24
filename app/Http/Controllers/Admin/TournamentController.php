<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tournament\TournamentCreateRequest;
use App\Http\Requests\Tournament\TournamentUpdateRequest;
use App\Models\News;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.tournament.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.tournament.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TournamentCreateRequest $request)
    {
        $input = $request->all();
        $input["start_at"] = Carbon::parse($input["start_at"]);
        $input["end_at"] = Carbon::parse($input["end_at"]);
        Tournament::add($input);
        return redirect()->route("tournament.index");
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
        $tournament = Tournament::find($id);
        if($tournament){
            return view("admin.tournament.edit",compact("tournament"));
        }
        return redirect()->route("tournament.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TournamentUpdateRequest $request, string $id)
    {
        $tournament = Tournament::find($id);
        if($tournament){
            $input = $request->all();
            $input["start_at"] = Carbon::parse($input["start_at"]);
            $input["end_at"] = Carbon::parse($input["end_at"]);
            $tournament->edit($input);
        }
        return redirect()->route("tournament.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
