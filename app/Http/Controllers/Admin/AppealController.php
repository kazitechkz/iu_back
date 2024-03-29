<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appeal\AppealCreateRequest;
use App\Http\Requests\Appeal\AppealUpdateRequest;
use App\Models\Appeal;
use App\Models\AppealType;
use App\Models\Subject;
use Illuminate\Http\Request;

class AppealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (auth()->user()->can("appeal index")) {
                $types = AppealType::all();
                $subjects = Subject::all();
                $appeals = Appeal::whereHas('question', function ($q) {
                    $q->where('deleted_at', null);
                })->latest()->paginate(10);
                return view("admin.appeal.index", compact('types', 'appeals', 'subjects'));
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    public function search(Request $request)
    {
        try {
            if (auth()->user()->can("appeal index")) {
                $types = AppealType::all();
                $subjects = Subject::all();
                $query = Appeal::query();
                if ($request['type_id'] != 0) {
                    $query = $query->where('type_id', $request['type_id']);
                }
                if ($request['status'] != 'all' || $request['status'] == 0) {
                    $query = $query->where('status', $request['status']);
                }
                if ($request['subject_id'] != 0) {
                    $appeals = $query->whereHas('question', function ($query) use ($request) {
                        $query->where('subject_id', $request['subject_id'])->where('deleted_at', null);
                    })->latest()->paginate(10);
                } else {
                    $appeals = $query->whereHas('question', function ($q) {
                        $q->where('deleted_at', null);
                    })->latest()->paginate(10);
                }
                return view("admin.appeal.index", compact('types', 'appeals', 'subjects'));
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
            if (auth()->user()->can("appeal create")) {
                return view("admin.appeal.create");
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
    public function store(AppealCreateRequest $request)
    {
        try {
            if (auth()->user()->can("appeal create")) {
                $input = $request->all();
                $input["user_id"] = auth()->user()->id;
                Appeal::add($input);
                return redirect()->route("appeal.index");
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
            if (auth()->user()->can("appeal show")) {
                $appeal = Appeal::findOrFail($id);
                if ($appeal->status) {
                    $appeal->status = 0;
                } else {
                    $appeal->status = 1;
                }
                $appeal->save();
                return redirect(route('appeal.index'));
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
            if (auth()->user()->can("appeal edit")) {
                if ($appeal = Appeal::find($id)) {
                    return view("admin.appeal.edit", compact("appeal"));
                }
                return redirect()->route("appeal.index");
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
    public function update(AppealUpdateRequest $request, string $id)
    {
        try {
            if (auth()->user()->can("appeal edit")) {
                if ($appeal = Appeal::find($id)) {
                    $input = $request->all();
                    $input["user_id"] = auth()->user()->id;
                    $appeal->edit($input);
                }
                return redirect()->route("appeal.index");
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
            if (auth()->user()->can("appeal edit")) {
                $appeal = Appeal::findOrFail($id);
                $appeal->delete();
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
