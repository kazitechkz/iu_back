<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CareerQuizQuestion\CareerQuizQuestionCreate;
use App\Http\Requests\CareerQuizQuestion\CareerQuizQuestionEdit;
use App\Models\CareerQuizQuestion;
use Illuminate\Http\Request;

class CareerQuizQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.career-quiz-question.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.career-quiz-question.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CareerQuizQuestionCreate $request)
    {
        try{
            $input = $request->all();
            CareerQuizQuestion::add($input);
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-question.index");
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
            $careerQuizQuestion = CareerQuizQuestion::find($id);
            if($careerQuizQuestion){
                return view("admin.career-quiz-question.edit",compact("careerQuizQuestion"));
            }
            else{
                toastr()->warning("Вопрос был изменен");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-question.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CareerQuizQuestionEdit $request, string $id)
    {
        try{
            $careerQuizQuestion = CareerQuizQuestion::find($id);
            if($careerQuizQuestion){
                $careerQuizQuestion->edit($request->all());
                toastr()->success("Успешно обновлены вопросы!");
            }
            else{
                toastr()->warning("Вопрос был изменен");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-question.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $careerQuizQuestion = CareerQuizQuestion::find($id);
            if($careerQuizQuestion){
                $careerQuizQuestion->destroy();
                toastr()->success("Успешно удалены вопросы!");
            }
            else{
                toastr()->warning("Вопрос был изменен");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-question.index");
    }
}
