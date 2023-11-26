<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechSupportType\TechSupportTypeCreateRequest;
use App\Http\Requests\TechSupportType\TechSupportTypeUpdateRequest;
use App\Models\TechSupportType;
use Illuminate\Http\Request;

class TechSupportTypeController extends Controller
{
    public function index()
    {
        try{
            if(auth()->user()->can("tech-support index") ){
                return view("admin.tech-support-type.index");
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
            if(auth()->user()->can("tech-support create") ){
                return view("admin.tech-support-type.create");
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
    public function store(TechSupportTypeCreateRequest $request)
    {
        try{
            if(auth()->user()->can("tech-support create") ){
                TechSupportType::add($request->all());
                return redirect()->route("tech-support-type.index");
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
            if(auth()->user()->can("tech-support show") ){

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
            if(auth()->user()->can("tech-support edit") ){
                if($techSupportType = TechSupportType::find($id))
                {
                    return view("admin.tech-support-type.edit",compact("techSupportType"));
                }
                return redirect()->route("tech-support-type.index");
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
    public function update(TechSupportTypeUpdateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("tech-support edit") ){
                if($techSupportType = TechSupportType::find($id)){
                    $techSupportType->edit($request->all());
                }
                return redirect()->route("tech-support-type.index");
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
            if(auth()->user()->can("tech-support edit") ){

                return redirect()->route("tech-support-type.index");
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
