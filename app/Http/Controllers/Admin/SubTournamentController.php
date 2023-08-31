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
        try{
            if(auth()->user()->can("sub-tournament index") ){
                return view("admin.sub-tournament.index");
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
            if(auth()->user()->can("sub-tournament create") ){

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
    public function store(SubTournamentCreateRequest $request)
    {
        try{
            if(auth()->user()->can("sub-tournament create") ){
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
            if(auth()->user()->can("sub-tournament show") ){

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
            if(auth()->user()->can("sub-tournament edit") ){
                if($sub_tournament = SubTournament::find($id)){
                    return view("admin.sub-tournament.edit",compact("sub_tournament"));
                }
                return redirect()->route("sub-tournament.index");
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
    public function update(Request $request, string $id)
    {
        try{
            if(auth()->user()->can("sub-tournament edit") ){
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
            if(auth()->user()->can("sub-tournament edit") ){

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
