<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appeal\AppealCreateRequest;
use App\Http\Requests\Appeal\AppealUpdateRequest;
use App\Models\Appeal;
use Illuminate\Http\Request;

class AppealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.appeal.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.appeal.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppealCreateRequest $request)
    {
        $input = $request->all();
        $input["user_id"] = auth()->user()->id;
        Appeal::add($input);
        return redirect()->route("appeal.index");
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
        if($appeal = Appeal::find($id)){
            return view("admin.appeal.edit",compact("appeal"));
        }
        return redirect()->route("appeal.index");

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppealUpdateRequest $request, string $id)
    {
        if($appeal = Appeal::find($id)){
            $input = $request->all();
            $input["user_id"] = auth()->user()->id;
            $appeal->edit($input);
        }
        return redirect()->route("appeal.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
