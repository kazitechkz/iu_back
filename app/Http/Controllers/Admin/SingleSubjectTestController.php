<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SingleSubjectTest\CreateRequest;
use App\Models\SingleSubjectTest;
use Illuminate\Http\Request;

class SingleSubjectTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.single-subject-test.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        SingleSubjectTest::add($request->all());
        return redirect(route('single-tests.index'));
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
        $singleSubjectTest = SingleSubjectTest::findOrFail($id);
        return view('admin.single-subject-test.edit', compact('singleSubjectTest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRequest $request, string $id)
    {
        $item = SingleSubjectTest::findOrFail($id);
        $item->edit($request->all());
        return redirect(route('single-subject-tests.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
