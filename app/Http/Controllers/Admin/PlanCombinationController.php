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
        return view("admin.plan-combination.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.plan-combination.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanCombinationCreateRequest $request)
    {
        $plan = Plan::find($request->get("plan_id"));
        if($plan){
            $plan->combinations()->create($request->all());
        }
        return redirect()->route("plan-combination.index");
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
        $plan_combination = PlanCombination::find($id);
        if($plan_combination){
            return view("admin.plan-combination.edit",compact("plan_combination"));
        }
        return  redirect()->route("plan-combination.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanCombinationUpdateRequest $request, string $id)
    {
        $plan_combination = PlanCombination::find($id);
        if($plan_combination){
           $plan_combination->update($request->all());
        }
        return  redirect()->route("plan-combination.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
