<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CareerQuizGroup\CareerQuizGroupCreate;
use App\Http\Requests\CareerQuizGroup\CareerQuizGroupEdit;
use App\Models\CareerQuizGroup;
use Illuminate\Http\Request;

class CareerQuizGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.career-quiz-group.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.career-quiz-group.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CareerQuizGroupCreate $request)
    {
        try{
            $input = $request->all();
            CareerQuizGroup::add($input);
            toastr()->success("Успешно создана группа");
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-group.index");
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
        try{
            $careerQuizGroup = CareerQuizGroup::find($id);
            if($careerQuizGroup){
                return view("admin.career-quiz-group.edit",compact("careerQuizGroup"));
            }
            else{
                toastr()->warning("Не найдено группы");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-group.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CareerQuizGroupEdit $request, string $id)
    {
        try{
            $careerQuizGroup = CareerQuizGroup::find($id);
            if($careerQuizGroup){
                $careerQuizGroup->edit($request->all());
                toastr()->success("Успешно изменена группа");
            }
            else{
                toastr()->warning("Не найдено группы");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-group.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $careerQuizGroup = CareerQuizGroup::find($id);
            if($careerQuizGroup){
               $careerQuizGroup->delete();
            }
            else{
                toastr()->warning("Не найдено группы");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-group.index");
    }
}
