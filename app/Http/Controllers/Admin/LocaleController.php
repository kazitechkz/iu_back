<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Locale\LocaleCreateRequest;
use App\Http\Requests\Locale\LocaleUpdateRequest;
use App\Models\Locale;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.locale.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.locale.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocaleCreateRequest $request)
    {
        $index = $request->all();
        $index["isActive"] = $request->boolean("isActive");
        Locale::add($index);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $locale = Locale::show($id);
        if($locale){
            return view("admin.locale.edit",compact("locale"));
        }
        return redirect()->route('locale.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocaleUpdateRequest $request, string $id)
    {
        $index = $request->all();
        $index["isActive"] = $request->boolean("isActive");
        $locale = Locale::show($id);
        if($locale){
            $locale->edit($index);
        }
        return redirect()->route('locale.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
