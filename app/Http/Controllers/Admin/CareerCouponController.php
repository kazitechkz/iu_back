<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CareerQuizCoupon\CareerQuizCouponCreate;
use App\Http\Requests\CareerQuizCoupon\CareerQuizCouponEdit;
use App\Models\CareerCoupon;
use App\Models\CareerQuiz;
use Illuminate\Http\Request;

class CareerCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.career-quiz-coupon.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.career-quiz-coupon.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CareerQuizCouponCreate $request)
    {
        try{

            $input = $request->all();
            $input["is_used"] = $request->boolean("is_used");
            $input["status"] = $request->boolean("status");
            if(!$request->get("career_quiz_id")){
                $quizzes = CareerQuiz::where(["group_id" => $request->get("career_group_id")])->get();
                foreach ($quizzes as $quiz){
                    $input["career_quiz_id"] = $quiz->id;
                    CareerCoupon::add($input);
                }
            }
            else{
                CareerCoupon::add($input);
            }

        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-coupon.index");
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
            $careerCoupon = CareerCoupon::find($id);
            if($careerCoupon){
                return view("admin.career-quiz-coupon.edit",compact("careerCoupon"));
            }
            toastr()->warning("Не найдено");
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-coupon.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CareerQuizCouponEdit $request, string $id)
    {
        try{
            $careerCoupon = CareerCoupon::find($id);
            if($careerCoupon){
                $input = $request->all();
                $input["is_used"] = $request->boolean("is_used");
                $input["status"] = $request->boolean("status");
                $careerCoupon->update($input);
            }
            else{
                toastr()->warning("Не найдено");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-coupon.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $careerCoupon = CareerCoupon::find($id);
            if($careerCoupon){
                $careerCoupon->delete();
            }
            else{
                toastr()->warning("Не найдено");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception);
        }
        return redirect()->route("career-quiz-coupon.index");
    }
}
