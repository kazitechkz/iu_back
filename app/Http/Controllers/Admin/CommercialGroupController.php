<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommercialGroup\CommercialGroupCreateRequest;
use App\Http\Requests\CommercialGroup\CommercialGroupUpdateRequest;
use App\Models\CommercialGroup;
use Illuminate\Http\Request;

class CommercialGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("commercial-group index") ){
                return view("admin.commercial-group.index");
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            if(auth()->user()->can("commercial-group create") ){
                return view("admin.commercial-group.create");
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommercialGroupCreateRequest $request)
    {
        try{
            if(auth()->user()->can("commercial-group create") ){
                $input = $request->all();
                $input["is_active"] = $request->boolean("is_active");
                $group = CommercialGroup::add($input);
                return redirect()->route("commercial-group.index");
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            if(auth()->user()->can("commercial-group show") ){

            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            if(auth()->user()->can("commercial-group edit") ){
                if($commercial_group = CommercialGroup::find($id))
                {
                    return view("admin.commercial-group.edit",compact("commercial_group"));
                }
                return redirect()->route("commercial-group.index");
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommercialGroupUpdateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("commercial-group edit") ){
                if($commercial_group = CommercialGroup::find($id)){
                    $input = $request->all();
                    $input["is_active"] = $request->boolean("is_active");
                    $commercial_group->edit($input);
                }
                return redirect()->route("commercial-group.index");
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            if(auth()->user()->can("commercial-group edit") ){

            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }
}
