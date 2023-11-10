<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MathFormulaHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubStep\SubStepUpdateRequest;
use App\Http\Requests\SubStepContent\SubStepContentCreateRequest;
use App\Http\Requests\SubStepContent\SubStepContentUpdateRequest;
use App\Models\Step;
use App\Models\SubStep;
use App\Models\SubStepContent;
use Illuminate\Http\Request;

class SubStepContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (auth()->user()->can("sub-step-content index")) {
                return view("admin.sub-step-content.index");
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
            if (auth()->user()->can("sub-step-content create")) {
                return view("admin.sub-step-content.create");
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
    public function store(SubStepContentCreateRequest $request)
    {
        try {
            if (auth()->user()->can("sub-step-content create")) {
                $input = MathFormulaHelper::getContent($request);
                SubStepContent::add($input);
                return redirect()->back();
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            if (auth()->user()->can("sub-step-content show")) {
                $sub_step = SubStep::find($id);
                if ($sub_step) {
                    return view("admin.sub-step-content.show", compact("sub_step"));
                } else {
                    toastr()->warning(__("message.not_found"));
                    return redirect()->back();
                }
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            if (auth()->user()->can("sub-step-content edit")) {
                $sub_step_content = SubStepContent::find($id);
                if ($sub_step_content) {
                    return view("admin.sub-step-content.edit", compact("sub_step_content"));
                } else {
                    toastr()->warning(__("message.not_found"));
                    return redirect()->back();
                }
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
     * Update the specified resource in storage.
     */
    public function update(SubStepContentUpdateRequest $request, string $id)
    {
        try {
            if (auth()->user()->can("sub-step-content edit")) {
                $sub_step_content = SubStepContent::find($id);
                if ($sub_step_content) {
                    $input = MathFormulaHelper::getContent($request);
                    $input["is_active"] = $request->boolean("is_active");
                    $sub_step_content->edit($input);
                    return redirect()->back();
                } else {
                    toastr()->warning(__("message.not_found"));
                }
                return redirect()->back();

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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if (auth()->user()->can("sub-step-content edit")) {
                $sub_step_content = SubStepContent::find($id);
                if ($sub_step_content) {

                } else {
                    toastr()->warning(__("message.not_found"));
                }
                return redirect()->back();

            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }
}
