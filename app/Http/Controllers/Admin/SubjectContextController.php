<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectContext\Create;
use App\Models\SubjectContext;
use Illuminate\Http\Request;

class SubjectContextController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.subject-context.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subject-context.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Create $request)
    {
        SubjectContext::add($request->all());
        return redirect(route('subject-contexts.index'));
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
        $ctx = SubjectContext::findOrFail($id);
        return view('admin.subject-context.edit', compact('ctx'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Create $request, string $id)
    {
        $ctx = SubjectContext::findOrFail($id);
        $ctx->edit($request->all());
        return redirect(route('subject-contexts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
