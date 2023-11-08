<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\ClassroomGroup;
use App\Services\ClassroomService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $classrooms = Classroom::with('classroom_group')->withCount('user')->where('student_id', auth()->guard('api')->id())->get();
            return response()->json(new ResponseJSON(
                status: true,
                data: $classrooms
            ));
        } catch (ValidationException $exception) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $exception->errors()
            ), 400);
        }
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
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
               'promo_code' => 'required'
            ]);
            return ClassroomService::addClassroomForStudent($request);
        } catch (ValidationException $exception) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $exception->errors()
            ), 400);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $class = Classroom::findOrFail($id);
            $class->delete();
            return response()->json(new ResponseJSON(
                status: true,
                data: true
            ));
        } catch (ValidationException $exception) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $exception->errors()
            ), 400);
        }
    }
}
