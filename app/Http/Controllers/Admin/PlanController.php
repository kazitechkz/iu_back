<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plan\PlanCreateRequest;
use Bpuig\Subby\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.plan.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.plan.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanCreateRequest $request)
    {
        $input = $request->all();
        $input["is_active"] = $request->boolean("is_active");
       Plan::create($input);
       return redirect()->back();
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
        $plan = Plan::find($id);
        if($plan){
            return view("admin.plan.edit",compact("plan"));
        }
        return redirect()->route("plan.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $plan = Plan::find($id);
        if($plan){
            $input = $request->all();
            $input["is_active"] = $request->boolean("is_active");
            $plan->update($input);
        }
        return redirect()->route("plan.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
