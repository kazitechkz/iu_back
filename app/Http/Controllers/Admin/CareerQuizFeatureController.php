<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CareerQuizFeature\CareerQuizFeatureCreate;
use App\Http\Requests\CareerQuizFeature\CareerQuizFeatureEdit;
use App\Models\CareerQuizFeature;
use Illuminate\Http\Request;

class CareerQuizFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.career-quiz-feature.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.career-quiz-feature.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CareerQuizFeatureCreate $request)
    {
        try{
            $input = $request->all();
            CareerQuizFeature::add($input);
            toastr()->success("Успешно добавлена характеристика");
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-feature.index");
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
            $careerQuizFeature = CareerQuizFeature::find($id);
            if($careerQuizFeature){
                return view("admin.career-quiz-feature.edit",compact("careerQuizFeature"));
            }
            else{
                toastr()->warning("Не найдена характеристика");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-feature.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CareerQuizFeatureEdit $request, string $id)
    {
        try{
            $careerQuizFeature = CareerQuizFeature::find($id);
            if($careerQuizFeature){
                $careerQuizFeature->edit($request->all());
                toastr()->success("Успешно изменена характеристика");
            }
            else{
                toastr()->warning("Не найдена характеристика");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-feature.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $careerQuizFeature = CareerQuizFeature::find($id);
            if($careerQuizFeature){
                $careerQuizFeature->delete();
                toastr()->success("Успешно удалена характеристика");
            }
            else{
                toastr()->warning("Не найдена характеристика");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-feature.index");
    }
}
