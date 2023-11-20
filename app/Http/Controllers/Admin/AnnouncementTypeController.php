<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementType\AnnouncementTypeCreateRequest;
use App\Http\Requests\AnnouncementType\AnnouncementTypeUpdateRequest;
use App\Models\AnnouncementType;
use Illuminate\Http\Request;

class AnnouncementTypeController extends Controller
{
    public function index()
    {
        try{
            if(auth()->user()->can("announcement index") ){
                return view("admin.announcement-type.index");
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
            if(auth()->user()->can("announcement create") ){
                return view("admin.announcement-type.create");
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
    public function store(AnnouncementTypeCreateRequest $request)
    {
        try{
            if(auth()->user()->can("announcement create") ){
                AnnouncementType::add($request->all());
                return redirect()->route("announcement-type.index");
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
            if(auth()->user()->can("announcement show") ){

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
            if(auth()->user()->can("announcement edit") ){
                if($announcement_type = AnnouncementType::find($id))
                {
                    return view("admin.announcement-type.edit",compact("announcement_type"));
                }
                return redirect()->route("announcement-type.index");
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
    public function update(AnnouncementTypeUpdateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("announcement edit") ){
                if($announcement = AnnouncementType::find($id)){
                    $announcement->edit($request->all());
                }
                return redirect()->route("announcement-type.index");
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
            if(auth()->user()->can("announcement edit") ){

                return redirect()->route("announcement-type.index");
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
