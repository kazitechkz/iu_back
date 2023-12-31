<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechSupportCategory\TechSupportCategoryUpdateRequest;
use App\Models\TechSupportCategory;
use Illuminate\Http\Request;

class TechSupportCategoryController extends Controller
{
    public function index()
    {
        try{
            if(auth()->user()->can("tech-support index") ){
                return view("admin.tech-support-category.index");
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
                return view("admin.tech-support-category.create");
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
    public function store(TechSupportCategoryCreateRequest $request)
    {
        try{
            if(auth()->user()->can("tech-support create") ){
                TechSupportCategory::add($request->all());
                return redirect()->route("tech-support-category.index");
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
                if($techSupportCategory = TechSupportCategory::find($id))
                {
                    return view("admin.tech-support-category.edit",compact("techSupportCategory"));
                }
                return redirect()->route("tech-support-category.index");
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
    public function update(TechSupportCategoryUpdateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("tech-support edit") ){
                if($techSupportCategory = TechSupportCategory::find($id)){
                    $techSupportCategory->edit($request->all());
                }
                return redirect()->route("tech-support-category.index");
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

                return redirect()->route("tech-support-category.index");
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
