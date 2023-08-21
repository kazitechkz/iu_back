<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Group\GroupTable;
use App\Http\Requests\Group\GroupCreateRequest;
use App\Http\Requests\Group\GroupUpdateRequest;
use App\Models\Group;
use App\Models\GroupPlan;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.group.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.group.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupCreateRequest $request)
    {
        $input = $request->all();
        $input["isActive"] = $request->boolean("isActive");
        $group = Group::add($input);
        if($request->get("planGroups")){
            foreach ($request->get("planGroups") as $plan){
                GroupPlan::add(["group_id"=>$group->id,"plan_id"=>$plan]);
            }
        }
        return redirect()->route("group.index");
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
        if($group = Group::find($id))
        {
            return view("admin.group.edit",compact("group"));
        }
        return redirect()->route("group.index");

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupUpdateRequest $request, string $id)
    {
        if($group = Group::find($id)){
            $input = $request->all();
            $input["isActive"] = $request->boolean("isActive");
            $group->edit($input);
        }
        return redirect()->route("group.index");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
