<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementGroup\AnnouncementGroupCreateRequest;
use App\Http\Requests\AnnouncementGroup\AnnouncementGroupUpdateRequest;
use App\Models\AnnouncementGroup;
use Illuminate\Http\Request;

class AnnouncementGroupController extends Controller
{
    public function index()
    {
        try{
            if(auth()->user()->can("announcement index") ){
                return view("admin.announcement-group.index");
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
                return view("admin.announcement-group.create");
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
    public function store(AnnouncementGroupCreateRequest $request)
    {
        try{
            if(auth()->user()->can("announcement create") ){
                $input = $request->all();
                $input["is_active"] = $request->boolean("is_active");
                AnnouncementGroup::add($input);
                return redirect()->route("announcement-group.index");
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
                if($announcement_group = AnnouncementGroup::find($id))
                {
                    return view("admin.announcement-group.edit",compact("announcement_group"));
                }
                return redirect()->route("announcement-group.index");
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
    public function update(AnnouncementGroupUpdateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("announcement edit") ){
                if($announcement = AnnouncementGroup::find($id)){
                    $input = $request->all();
                    $input["is_active"] = $request->boolean("is_active");
                    $announcement->edit($input);
                }
                return redirect()->route("announcement-group.index");
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
        try {
            if (auth()->user()->can("announcement edit")) {

                return redirect()->route("announcement-group.index");
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
