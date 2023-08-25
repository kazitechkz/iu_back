<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubTournament\SubTournamentCreateRequest;
use App\Models\SubTournament;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SubTournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.sub-tournament.index");

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubTournamentCreateRequest $request)
    {
        $input = $request->all();
        $input["question_quantity"] =
            $request->get("single_question_quantity") +
            $request->get("multiple_question_quantity") +
            $request->get("context_question_quantity");
        $input["max_point"] =
            $request->get("single_question_quantity") +
            $request->get("multiple_question_quantity") * 2 +
            $request->get("context_question_quantity");
        $input["start_at"] = Carbon::parse($input["start_at"]);
        $input["end_at"] = Carbon::parse($input["end_at"]);
        SubTournament::add($input);
        return redirect()->back();

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
        if($sub_tournament = SubTournament::find($id)){
            return view("admin.sub-tournament.edit",compact("sub_tournament"));
        }
        return redirect()->route("sub-tournament.index");

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($sub_tournament = SubTournament::find($id)){
            $input = $request->all();
            $input["question_quantity"] =
                $request->get("single_question_quantity") +
                $request->get("multiple_question_quantity") +
                $request->get("context_question_quantity");
            $input["max_point"] =
                $request->get("single_question_quantity") +
                $request->get("multiple_question_quantity") * 2 +
                $request->get("context_question_quantity");
            $input["start_at"] = Carbon::parse($input["start_at"]);
            $input["end_at"] = Carbon::parse($input["end_at"]);
            $sub_tournament->edit($input);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
