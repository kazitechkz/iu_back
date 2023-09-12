<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParticipantRating\ParticipantRatingCreateRequest;
use App\Http\Requests\ParticipantRating\ParticipantRatingUpdateRequest;
use App\Models\ParticipantRating;
use Illuminate\Http\Request;

class ParticipantRatingController extends Controller
{
    public function index()
    {
        try{
            if(auth()->user()->can("participant-rating index") ){
                return view("admin.participant-rating.index");
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
            if(auth()->user()->can("participant-rating create") ){
                return view("admin.participant-rating.create");
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
    public function store(ParticipantRatingCreateRequest $request)
    {
        try{
            if(auth()->user()->can("participant-rating create") ){
                ParticipantRating::add($request->all());
                return redirect()->route("participant-rating.index");
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
            if(auth()->user()->can("participant-rating show") ){

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
            if(auth()->user()->can("participant-rating edit") ){
                if($participant_rating = ParticipantRating::find($id)){
                    return view("admin.participant-rating.edit",compact("participant_rating"));
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

    /**
     * Update the specified resource in storage.
     */
    public function update(ParticipantRatingUpdateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("participant-rating edit") ){
                if($participant_rating = ParticipantRating::find($id)){
                    $participant_rating->edit($request->all());
                }
                return redirect()->route("participant-rating.index");
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
            if(auth()->user()->can("participant-rating edit") ){

                return redirect()->route("participant-rating.index");
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
