<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IUTubeVideo\IUTubeVideoCreateRequest;
use App\Http\Requests\IUTubeVideo\IUTubeVideoEditRequest;
use App\Models\IutubeVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IUTubeVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("iutube index") ){
                return view("admin.iutube-video.index");
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
            if(auth()->user()->can("iutube create") ){
                return view("admin.iutube-video.create");
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
    public function store(IUTubeVideoCreateRequest $request)
    {
        try{
            if(auth()->user()->can("iutube create") ){
                $input = $request->all();
                $input["alias"] = Str::uuid();
                $input["is_public"] = $request->boolean("is_public");
                $input["is_recommended"] = $request->boolean("is_recommended");
                IutubeVideo::add($input);
                toastr()->success("Успешно добавлено видео");
                return redirect()->route("iutube-video.index");
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            if(auth()->user()->can("iutube edit") ){
               $video = IutubeVideo::find($id);
               if($video){
                   return view("admin.iutube-video.edit",compact("video"));
               }
               else{
                   toastr()->warning(__("message.not_found"));
                   return redirect()->route("iutube-video.index");
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
     * Update the specified resource in storage.
     */
    public function update(IUTubeVideoEditRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("iutube edit") ){
                $video = IutubeVideo::find($id);
                if($video){
                    $input = $request->all();
                    $input["alias"] = Str::uuid();
                    $input["is_public"] = $request->boolean("is_public");
                    $input["is_recommended"] = $request->boolean("is_recommended");
                    $video->edit($input);
                    toastr()->success("Видео успешно обновлено");
                    return redirect()->route("iutube-video.index");
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("iutube-video.index");
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            if(auth()->user()->can("iutube edit") ){
                $video = IutubeVideo::find($id);
                if($video){
                    $video->delete();
                    toastr()->success("Видео успешно обновлено");
                    return redirect()->route("iutube-video.index");
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("iutube-video.index");
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
}
