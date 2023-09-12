<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRating\LessonRatingCreateRequest;
use App\Http\Requests\LessonRating\LessonRatingUpdateRequest;
use App\Http\Requests\LessonSchedule\LessonScheduleCreateRequest;
use App\Http\Requests\LessonSchedule\LessonScheduleUpdateRequest;
use App\Models\LessonRating;
use App\Models\LessonSchedule;
use Illuminate\Http\Request;

class LessonRatingController extends Controller
{
    public function index()
    {
        try{
            if(auth()->user()->can("lesson-rating index") ){
                return view("admin.lesson-rating.index");
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
            if(auth()->user()->can("lesson-rating create") ){
                return view("admin.lesson-rating.create");
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
    public function store(LessonRatingCreateRequest $request)
    {
        try{
            if(auth()->user()->can("lesson-rating create") ){
                LessonRating::add($request->all());
                return redirect()->route("lesson-rating.index");
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
            if(auth()->user()->can("lesson-rating show") ){

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
            if(auth()->user()->can("lesson-rating edit") ){
                if($lesson_rating = LessonRating::find($id)){
                    return view("admin.lesson-rating.edit",compact("lesson_rating"));
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
    public function update(LessonRatingUpdateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("lesson-rating edit") ){
                if($lesson_rating = LessonRating::find($id)){
                    $lesson_rating->edit($request->all());
                }
                return redirect()->route("lesson-rating.index");
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
            if(auth()->user()->can("lesson-rating edit") ){

                return redirect()->route("lesson-rating.index");
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
