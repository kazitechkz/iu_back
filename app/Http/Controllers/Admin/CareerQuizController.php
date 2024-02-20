<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CareerQuiz\CareerQuizCreate;
use App\Http\Requests\CareerQuiz\CareerQuizEdit;
use App\Models\CareerQuiz;
use App\Models\CareerQuizCreator;
use Illuminate\Http\Request;

class CareerQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.career-quiz.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.career-quiz.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CareerQuizCreate $request)
    {
        try {
            $input = $request->all();
            $careerQuiz = CareerQuiz::add($input);
            toastr()->success("Создан профориентационный тест");
            dd($input);
            if($request->has("authors")){
                $raw_data = [];
                $authors = json_decode($request->get("authors"),true);
                foreach ($authors as $author){
                    array_push($raw_data,["quiz_id"=>$careerQuiz->id,"author_id"=>$author]);
                }
                CareerQuizCreator::insert($raw_data);
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz.index");
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
        try {
            $careerQuiz = CareerQuiz::with(["file"])->find($id);
            if($careerQuiz){
                return view("admin.career-quiz.edit",compact("careerQuiz"));
            }
            else{
                toastr()->warning("Не найден профориентационный тест");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CareerQuizEdit $request, string $id)
    {
        try {
            $careerQuiz = CareerQuiz::with(["file"])->find($id);
            if($careerQuiz){
               $careerQuiz->edit($request->all());
               toastr()->success("Успешно изменен");
                if($request->has("authors")){
                    CareerQuizCreator::where(["quiz_id" => $careerQuiz->id])->delete();
                    $raw_data = [];
                    $authors = json_decode($request->get("authors"),true);
                    foreach ($authors as $author){
                        array_push($raw_data,["quiz_id"=>$careerQuiz->id,"author_id"=>$author]);
                    }
                    CareerQuizCreator::insert($raw_data);
                }
            }
            else{
                toastr()->warning("Не найден профориентационный тест");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $careerQuiz = CareerQuiz::with(["file"])->find($id);
            if($careerQuiz){
                $careerQuiz->delete();
                toastr()->success("Успешно удалено");
            }
            else{
                toastr()->warning("Не найден профориентационный тест");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz.index");
    }
}
