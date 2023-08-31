<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanCombination\PlanCombinationCreateRequest;
use App\Http\Requests\PlanCombination\PlanCombinationUpdateRequest;
use Bpuig\Subby\Models\Plan;
use Bpuig\Subby\Models\PlanCombination;
use Illuminate\Http\Request;

class PlanCombinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("plan-combination index") ){
                return view("admin.plan-combination.index");
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
            if(auth()->user()->can("plan-combination create") ){
                return view("admin.plan-combination.create");
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
    public function store(PlanCombinationCreateRequest $request)
    {
        try{
            if(auth()->user()->can("plan-combination create") ){
                $plan = Plan::find($request->get("plan_id"));
                if($plan){
                    $plan->combinations()->create($request->all());
                }
                return redirect()->route("plan-combination.index");
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
            if(auth()->user()->can("plan-combination show") ){

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
            if(auth()->user()->can("plan-combination edit") ){
                $plan_combination = PlanCombination::find($id);
                if($plan_combination){
                    return view("admin.plan-combination.edit",compact("plan_combination"));
                }
                return  redirect()->route("plan-combination.index");
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
    public function update(PlanCombinationUpdateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("plan-combination edit") ){
                $plan_combination = PlanCombination::find($id);
                if($plan_combination){
                    $plan_combination->update($request->all());
                }
                return  redirect()->route("plan-combination.index");
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
            if(auth()->user()->can("plan-combination edit") ){

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
