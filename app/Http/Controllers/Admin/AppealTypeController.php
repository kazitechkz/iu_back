<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppealType\AppealTypeCreateRequest;
use App\Http\Requests\AppealType\AppealTypeUpdateRequest;
use App\Models\AppealType;
use Illuminate\Http\Request;

class AppealTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.appeal-type.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.appeal-type.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppealTypeCreateRequest $request)
    {
        $input = $request->all();
        $input["isActive"] = $request->boolean("isActive");
        AppealType::add($input);
        return redirect()->route("appeal-type.index");
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
        $appeal_type = AppealType::find($id);
        if($appeal_type){
            return view("admin.appeal-type.edit",compact("appeal_type"));
        }
        return redirect()->route("appeal-type.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppealTypeUpdateRequest $request, string $id)
    {
        $appeal_type = AppealType::find($id);
        if($appeal_type){
            $input = $request->all();
            $input["isActive"] = $request->boolean("isActive");
           $appeal_type->edit($input);
        }
        return redirect()->route("appeal-type.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
