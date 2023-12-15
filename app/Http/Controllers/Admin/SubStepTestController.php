<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MathFormulaHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubStepTest\SubStepTestCreateRequest;
use App\Models\MethodistContentStat;
use App\Models\Question;
use App\Models\SubQuestion;
use App\Models\SubStep;
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
                $sub_step_test = SubStepTest::createSubStepTest($request);
                if($sub_step_test){
                    MethodistContentStat::add(["sub_step_tests_id"=>$sub_step_test->id,"created_user"=>auth()->id()]);
                }
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
                $sub_step = SubStep::with('step')->findOrFail($id);
                return view('admin.sub-step-test.show', compact('sub_step'));
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
                $subStepTest = SubStepTest::with('subQuestion')->findOrFail($id);
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
                $subStepTest = SubStepTest::findOrFail($id);
                $subStepTest->updateSubStepTest($request);
                if($subStepTest){
                    $stat = MethodistContentStat::where(["sub_step_tests_id"=>$subStepTest->id])->first();
                    if($stat){
                        $stat->edit(["updated_user"=>auth()->id()]);
                    }
                    else{
                        MethodistContentStat::add(["sub_step_tests_id"=>$subStepTest->id,"updated_user"=>auth()->id()]);
                    }
                }
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
