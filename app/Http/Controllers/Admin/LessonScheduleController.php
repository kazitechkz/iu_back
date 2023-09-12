<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonSchedule\LessonScheduleCreateRequest;
use App\Http\Requests\LessonSchedule\LessonScheduleUpdateRequest;
use App\Models\LessonSchedule;
use Illuminate\Http\Request;

class LessonScheduleController extends Controller
{
    public function index()
    {
        try{
            if(auth()->user()->can("lesson-schedule index") ){
                return view("admin.lesson-schedule.index");
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
            if(auth()->user()->can("lesson-schedule create") ){
                return view("admin.lesson-schedule.create");
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
    public function store(LessonScheduleCreateRequest $request)
    {
        try{
            if(auth()->user()->can("lesson-schedule create") ){
                LessonSchedule::add($request->all());
                return redirect()->route("lesson-schedule.index");
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
            if(auth()->user()->can("lesson-schedule show") ){

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
            if(auth()->user()->can("lesson-schedule edit") ){
                if($lesson_schedule = LessonSchedule::find($id)){
                    return view("admin.lesson-schedule.edit",compact("lesson_schedule"));
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
    public function update(LessonScheduleUpdateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("lesson-schedule edit") ){
                if($lesson_schedule = LessonSchedule::find($id)){
                    $lesson_schedule->edit($request->all());
                }
                return redirect()->route("lesson-schedule.index");
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
            if(auth()->user()->can("lesson-schedule edit") ){

                return redirect()->route("lesson-schedule.index");
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
