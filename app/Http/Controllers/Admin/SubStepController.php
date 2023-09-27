<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubStep\SubStepCreateRequest;
use App\Http\Requests\SubStep\SubStepUpdateRequest;
use App\Models\Step;
use App\Models\SubCategory;
use App\Models\Subject;
use App\Models\SubStep;
use Illuminate\Http\Request;

class SubStepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("sub-step index") ){
                return view('admin.sub-step.index');
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
            if(auth()->user()->can("sub-step create") ){
                return view('admin.sub-step.create');
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
    public function store(SubStepCreateRequest $request)
    {
        try{
            if(auth()->user()->can("sub-step create") ){
                $another_step = SubStep::where(["level"=>$request->get("level"),"step_id" => $request->get("step_id")])->first();
                if($another_step){
                    toastr()->warning("Такой уровень уже существует");
                    return redirect()->back();
                }
                $input = $request->all();
                $input["is_active"] = $request->boolean("is_active");
                SubStep::add($input);
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
            if(auth()->user()->can("sub-step show") ){
                if($sub_step = SubStep::find($id)){
                    return view("admin.sub-step.edit",compact("sub_step"));
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("home");
                }
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
            if(auth()->user()->can("sub-step edit") ){
                if($sub_step = SubStep::find($id)){
                    return view("admin.sub-step.edit",compact("sub_step"));
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("home");
                }
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
    public function update(SubStepUpdateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("sub-step edit") ){
                if($sub_step = SubStep::find($id)){
                    $another_step = SubStep::where(["level"=>$request->get("level"),"step_id" => $request->get("step_id")])->first();
                    if($another_step){
                        if($another_step->id != $sub_step->id){
                            toastr()->warning("Такой уровень уже существует");
                            return redirect()->back();
                        }
                    }
                    $input = $request->all();
                    $input["is_active"] = $request->boolean("is_active");
                    $sub_step->edit($input);
                }
                else{
                    toastr()->warning(__("message.not_found"));
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
            if(auth()->user()->can("sub-step edit") ){
                if($sub_step = SubStep::find($id)){

                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("home");
                }
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
