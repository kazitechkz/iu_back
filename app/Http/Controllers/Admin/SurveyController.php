<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (auth()->user()->can("survey index")) {
                return view("admin.survey.index");
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            if (auth()->user()->can("survey create")) {
                return view("admin.survey.create");
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if (auth()->user()->can("survey edit")) {
                $this->validate($request, [
                   'title' => 'required'
                ]);
                Survey::create([
                   'title' => $request['title'],
                   'is_subscription' => $request->has('is_subscription'),
                    'status' => $request->has('status')
                ]);
                return view("admin.survey.index");
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->back();
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
        //
    }
}
