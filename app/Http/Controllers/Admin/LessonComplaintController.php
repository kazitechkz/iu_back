<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonComplaint\LessonComplaintCreateRequest;
use App\Http\Requests\LessonComplaint\LessonComplaintUpdateRequest;
use App\Models\LessonComplaint;
use Illuminate\Http\Request;

class LessonComplaintController extends Controller
{
    public function index()
    {
        try{
            if(auth()->user()->can("lesson-complaint index") ){
                return view("admin.lesson-complaint.index");
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
            if(auth()->user()->can("lesson-complaint create") ){
                return view("admin.lesson-complaint.create");
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
    public function store(LessonComplaintCreateRequest $request)
    {
        try{
            if(auth()->user()->can("lesson-complaint create") ){
                LessonComplaint::add($request->all());
                return redirect()->route("lesson-complaint.index");
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
            if(auth()->user()->can("lesson-complaint show") ){

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
            if(auth()->user()->can("lesson-complaint edit") ){
                if($lesson_complaint = LessonComplaint::find($id)){
                    return view("admin.lesson-complaint.edit",compact("lesson_complaint"));
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
    public function update(LessonComplaintUpdateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("lesson-complaint edit") ){
                if($lesson_complaint = LessonComplaint::find($id)){
                    $lesson_complaint->edit($request->all());
                }
                return redirect()->route("lesson-complaint.index");
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
            if(auth()->user()->can("lesson-complaint edit") ){

                return redirect()->route("lesson-complaint.index");
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
