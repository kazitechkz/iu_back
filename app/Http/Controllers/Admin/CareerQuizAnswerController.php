<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CareerQuizAnswer\CareerQuizAnswerCreate;
use App\Http\Requests\CareerQuizAnswer\CareerQuizAnswerEdit;
use App\Models\CareerQuizAnswer;
use Illuminate\Http\Request;

class CareerQuizAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.career-quiz-answer.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.career-quiz-answer.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CareerQuizAnswerCreate $request)
    {
        try {
            $input = $request->all();
            CareerQuizAnswer::add($input);
            toastr()->success("Добавлено ответы к тесту!");
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-answer.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $careerQuizAnswer = CareerQuizAnswer::find($id);
            if($careerQuizAnswer){
                return view("admin.career-quiz-answer.edit",compact("careerQuizAnswer"));
            }
            else{
                toastr()->warning("Не найден вопрос");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-answer.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CareerQuizAnswerEdit $request, string $id)
    {
        try {
            $careerQuizAnswer = CareerQuizAnswer::find($id);
            if($careerQuizAnswer){
               $careerQuizAnswer->edit($request->all());
                toastr()->success("Изменен ответ к тесту!");
            }
            else{
                toastr()->warning("Не найден вопрос");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-answer.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $careerQuizAnswer = CareerQuizAnswer::find($id);
            if($careerQuizAnswer){
                $careerQuizAnswer->destroy();
            }
            else{
                toastr()->warning("Не найден вопрос");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-answer.index");
    }
}
