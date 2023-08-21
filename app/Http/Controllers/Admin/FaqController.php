<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\FaqCreateRequest;
use App\Http\Requests\Faq\FaqUpdateRequest;
use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.faq.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.faq.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqCreateRequest $request)
    {
        $input = $request->all();
        $input["is_active"] = $request->boolean("is_active");
        Faq::add($input);
        return redirect()->route("faq.index");
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
        $faq = Faq::find($id);
        if($faq){
            return view("admin.faq.edit",compact("faq"));
        }
        return redirect()->back("faq.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqUpdateRequest $request, string $id)
    {
        $faq = Faq::find($id);
        if($faq){
            $input = $request->all();
            $input["is_active"] = $request->boolean("is_active");
            $faq->edit($input);
        }
        return redirect()->route("faq.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
