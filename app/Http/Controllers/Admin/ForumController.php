<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forum\ForumCreateRequest;
use App\Http\Requests\Forum\ForumUpdateRequest;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.forum.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.forum.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ForumCreateRequest $request)
    {
        $input = $request->all();
        $input["user_id"] = auth()->id();
        Forum::add($input);
        return redirect()->route("forum.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $forum = Forum::find($id);
        if($forum){
            return view("admin.forum.show",compact("forum"));
        }
        return redirect()->route("forum.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $forum = Forum::find($id);
        if($forum){
            return view("admin.forum.edit",compact("forum"));
        }
        return redirect()->route("forum.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ForumUpdateRequest $request, string $id)
    {
        $forum = Forum::find($id);
        if($forum){
            $input = $request->all();
            $input["user_id"] = auth()->id();
            $forum->edit($input);
        }
        return redirect()->route("forum.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
