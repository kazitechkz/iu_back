<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubStepVideo\SubStepVideoCreate;
use App\Models\MethodistContentStat;
use App\Models\SubStep;
use App\Models\SubStepVideo;
use Illuminate\Http\Request;

class SubStepVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("subStepVideo index") ){
                return view('admin.sub-step-video.index');
            }
            else {
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
            if(auth()->user()->can("subStepVideo index") ){
                return view('admin.sub-step-video.create');
            }
            else {
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
    public function store(SubStepVideoCreate $request)
    {
        try{
            if(auth()->user()->can("subStepVideo index") ){
                $sub_step_video = SubStepVideo::add($request->all());
                if($sub_step_video){
                    MethodistContentStat::add(["sub_step_video_id"=>$sub_step_video->id,"created_user"=>auth()->id()]);
                }
                return redirect(route('sub-step-video.index'));
            }
            else {
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
            if(auth()->user()->can("subStepVideo show") ){
                $sub_step = SubStep::find($id);
                if($sub_step){
                    return view("admin.sub-step-video.show",compact("sub_step"));
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->back();
                }
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
            if(auth()->user()->can("subStepVideo index") ){
                $video = SubStepVideo::with('sub_step.step.subject')->findOrFail($id);
                return view('admin.sub-step-video.edit', compact('video'));
            }
            else {
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
    public function update(SubStepVideoCreate $request, string $id)
    {
        try{
            if(auth()->user()->can("subStepVideo index") ){
                $video = SubStepVideo::findOrFail($id);
                $video->edit($request->all());
                if($video){
                    $stat = MethodistContentStat::where(["sub_step_video_id"=>$video->id])->first();
                    if($stat){
                          $stat->edit(["updated_user"=>auth()->id()]);
                    }
                    else{
                        MethodistContentStat::add(["sub_step_video_id"=>$video->id,"updated_user"=>auth()->id()]);
                    }
                }
                return redirect(route('sub-step-video.index'));
            }
            else {
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
        //
    }
}
