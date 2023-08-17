<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subject\SubjectCreateRequest;
use App\Http\Requests\Subject\SubjectEditRequest;
use App\Models\File;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd(File::getFileFromAWS('subjects/onw.png'));
//        $test = Subject::with('image')->find(17);
//        dd($test);
        return view('admin.subject.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectCreateRequest $request)
    {
        $data = Subject::initialData($request);
        Subject::add($data);
        return redirect(route('subject.index'));
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
        $subject = Subject::findOrFail($id);
        return view('admin.subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectEditRequest $request, string $id)
    {
        $data = Subject::initialData($request);
        $subject = Subject::findOrFail($id);
        $subject->edit($data);
        return redirect(route('subject.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
