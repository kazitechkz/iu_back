<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Promocode\PromocodeCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Zorb\Promocodes\Facades\Promocodes;
use Zorb\Promocodes\Models\Promocode;

class PromocodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.promocode.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.promocode.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PromocodeCreateRequest $request)
    {

        Promocodes::count($request->get("count")) // default: 1
        ->usages($request->get("usages")) // default: 1
        ->expiration(Carbon::parse($request->get("expiration_date"))) // default: null
        ->details(['points' => $request->get("points")]) // default: []
        ->create();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $promocode = Promocode::available()->find($id);
        if($promocode){

        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

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
