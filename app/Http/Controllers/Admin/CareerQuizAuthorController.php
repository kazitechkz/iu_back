<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CareerQuizAuthor\CareerQuizAuthorCreate;
use App\Http\Requests\CareerQuizAuthor\CareerQuizAuthorEdit;
use App\Models\CareerQuizAuthor;
use Illuminate\Http\Request;

class CareerQuizAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.career-quiz-author.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.career-quiz-author.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CareerQuizAuthorCreate $request)
    {
        try{
            $input = $request->all();
            CareerQuizAuthor::add($input);
            toastr()->success("Успешно создан автор теста");
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-author.index");
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
            $careerQuizAuthor = CareerQuizAuthor::find($id);
            if($careerQuizAuthor){
                return view("admin.career-quiz-author.edit",compact("careerQuizAuthor"));
            }
            else{
                toastr()->warning("Не найден автор теста");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-author.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CareerQuizAuthorEdit $request, string $id)
    {
        try{
            $careerQuizAuthor = CareerQuizAuthor::find($id);
            if($careerQuizAuthor){
               $careerQuizAuthor->edit($request->all());
               toastr()->success("Успешно изменен автор");
            }
            else{
                toastr()->warning("Не найден автор теста");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-author.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $careerQuizAuthor = CareerQuizAuthor::find($id);
            if($careerQuizAuthor){
                $careerQuizAuthor->delete();
                toastr()->success("Успешно удален автор");
            }
            else{
                toastr()->warning("Не найден автор теста");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-author.index");
    }
}
