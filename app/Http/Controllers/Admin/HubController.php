<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hub;
use Illuminate\Http\Request;

class HubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (auth()->guard('web')->user()->can("user-hubs index")) {
                return view('admin.hub.index');
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
            if (auth()->guard('web')->user()->can("user-hubs create")) {
                return view('admin.hub.create');
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
            if (auth()->guard('web')->user()->can("user-hubs create")) {
                $this->validate($request, [
                   'title_kk' => 'required',
                   'title_ru' => 'required'
                ]);
                Hub::create([
                   'title_kk' => $request['title_kk'],
                   'title_ru' => $request['title_ru']
                ]);
                return redirect(route('hubs.index'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            if (auth()->guard('web')->user()->can("user-hubs edit")) {
                $hub = Hub::findOrFail($id);
                return view('admin.hub.edit', compact('hub'));
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
    public function update(Request $request, string $id)
    {
        try {
            if (auth()->guard('web')->user()->can("user-hubs edit")) {
                $this->validate($request, [
                    'title_kk' => 'required',
                    'title_ru' => 'required'
                ]);
                $hub = Hub::findOrFail($id);
                $hub->title_ru = $request['title_ru'];
                $hub->title_kk = $request['title_kk'];
                $hub->save();
                return redirect(route('hubs.index'));
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
            if (auth()->guard('web')->user()->can("user-hubs edit")) {
                $hub = Hub::findOrFail($id);
                $hub->destroy();
                return redirect(route('hubs.index'));
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
