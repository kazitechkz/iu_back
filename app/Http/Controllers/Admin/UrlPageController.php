<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UrlPageImport;
use App\Models\UrlPage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class UrlPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (auth()->user()->can("url-page index")) {
                return view("admin.url-page.index");
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    public function getImport()
    {
        try {
            if (auth()->user()->can("url-page index")) {
                return view("admin.url-page.import");
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    public function postImport(Request $request)
    {
        try {
            if (auth()->user()->can("url-page index")) {
                $this->validate($request, ['file' => 'required']);
                Excel::import(new UrlPageImport(), $request['file']);
                toastr()->success('Успешно импортирован!');
                return redirect(route('url-pages.index'));
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
            if (auth()->user()->can("url-page create")) {
                return view("admin.url-page.create");
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
            if (auth()->user()->can("url-page create")) {
                $this->validate($request, ['title' => 'required|unique:url_pages', 'url' => 'required|url|unique:url_pages']);
                UrlPage::create(['title' => $request['title'], 'url' => $request['url']]);
                return redirect(route('url-pages.index'));
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
        try {
            if (auth()->user()->can("url-page edit")) {
                $url = UrlPage::findOrFail($id);
                return view("admin.url-page.edit", compact('url'));
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
            if (auth()->user()->can("url-page edit")) {
                $this->validate($request, [
                    'title' => ['required', Rule::unique('url_pages')->ignore($id)],
                    'url' => ['required', Rule::unique('url_pages')->ignore($id)]
                ]);
                $url = UrlPage::findOrFail($id);
                $url->title = $request['title'];
                $url->url = $request['url'];
                $url->save();
                return redirect(route('url-pages.index'));
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
            if (auth()->user()->can("url-page edit")) {
                return view("admin.url-page.index");
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
