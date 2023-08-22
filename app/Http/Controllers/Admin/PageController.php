<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\PageCreateRequest;
use App\Http\Requests\Page\PageUpdateRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.page.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.page.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageCreateRequest $request)
    {
        $input = $request->all();
        $input["isActive"] = $request->boolean("isActive");
        Page::add($input);
        return redirect()->route("page.index");
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
        $page = Page::find($id);
        if($page){
            return view("admin.page.edit",compact("page"));
        }
        return redirect()->route("page.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageUpdateRequest $request, string $id)
    {
        $page = Page::find($id);
        if($page){
            $input = $request->all();
            $input["isActive"] = $request->boolean("isActive");
            $page->edit($input);
        }
        return redirect()->route("page.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
