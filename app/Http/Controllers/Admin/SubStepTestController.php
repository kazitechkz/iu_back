<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubStepTest\SubStepTestCreateRequest;
use App\Models\SubQuestion;
use App\Models\SubStepTest;
use Illuminate\Http\Request;

class SubStepTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("substeptest index") ){
                return view('admin.sub-step-test.index');
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
            if(auth()->user()->can("substeptest index") ){
                return view('admin.sub-step-test.create');
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
    public function store(SubStepTestCreateRequest $request)
    {
        try{
            if(auth()->user()->can("substeptest index") ){
                $sub_question = SubQuestion::add($request->all());
                $data['sub_step_id'] = $request['sub_step_id'];
                $data['sub_question_id'] = $sub_question->id;
                SubStepTest::add($data);
                return redirect(route('sub-step-test.index'));
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
            if(auth()->user()->can("substeptest index") ){

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
            if(auth()->user()->can("substeptest index") ){
                $subStepTest = SubStepTest::findOrFail($id);
                return view('admin.sub-step-test.edit', compact('subStepTest'));
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
    public function update(SubStepTestCreateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("substeptest index") ){
                $query = SubStepTest::findOrFail($id);
                $sub_question = SubQuestion::add($request->all());
                $data['sub_step_id'] = $request['sub_step_id'];
                $data['sub_question_id'] = $sub_question->id;
                $query->edit($data);
                return redirect(route('sub-step-test.index'));
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
        //
    }
}
