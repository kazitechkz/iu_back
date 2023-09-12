<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Step\StepCreateRequest;
use App\Http\Requests\Step\StepUpdateRequest;
use App\Models\Category;
use App\Models\Step;
use Illuminate\Http\Request;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("step index") ){
                return view("admin.step.index");
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
            if(auth()->user()->can("step create") ){
                return view("admin.step.create");
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
    public function store(StepCreateRequest $request)
    {
        try{
            if(auth()->user()->can("step create") ){
                $input = $request->all();
                $input["is_active"] = $request->boolean("is_active");
                $input["is_free"] = $request->boolean("is_free");
                Step::add($input);
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
            if(auth()->user()->can("step show") ){
                $step = Step::find($id);
                if($step){
                    return view("admin.step.show",compact("step"));
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->back();
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
            if(auth()->user()->can("step edit") ){
                $step = Step::find($id);
                if($step){
                    return view("admin.step.edit",compact("step"));
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->back();
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
    public function update(StepUpdateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("step edit") ){
                $step = Step::find($id);
                if($step){
                    $input = $request->all();
                    $input["is_active"] = $request->boolean("is_active");
                    $input["is_free"] = $request->boolean("is_free");
                    $step->edit($input);
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
            if(auth()->user()->can("step show") ){
                $step = Step::find($id);
                if($step){

                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->back();
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
