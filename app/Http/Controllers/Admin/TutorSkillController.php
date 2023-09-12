<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TutorSkill\TutorSkillCreateRequest;
use App\Http\Requests\TutorSkill\TutorSkillUpdateRequest;
use App\Models\TutorSkill;
use Illuminate\Http\Request;

class TutorSkillController extends Controller
{
    public function index()
    {
        try{
            if(auth()->user()->can("tutor-skill index") ){
                return view("admin.tutor-skill.index");
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
            if(auth()->user()->can("tutor-skill create") ){
                return view("admin.tutor-skill.create");
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
    public function store(TutorSkillCreateRequest $request)
    {
        try{
            if(auth()->user()->can("tutor-skill create") ){
                    TutorSkill::add($request->all());
                return redirect()->route("tutor-skill.index");
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
            if(auth()->user()->can("tutor-skill show") ){

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
            if(auth()->user()->can("tutor-skill edit") ){
                return redirect()->route("tutor-skill.index");
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
    public function update(TutorSkillUpdateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("tutor-skill edit") ){
                if($tutor_skill = TutorSkill::find($id)){
                    $tutor_skill->edit($request->all());
                }
                return redirect()->route("tutor-skill.index");
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
            if(auth()->user()->can("tutor-skill edit") ){

                return redirect()->route("tutor-skill.index");
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
