<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IUTubeAccess\IUTubeAccessCreateRequest;
use App\Http\Requests\IUTubeAccess\IUTubeAccessEditRequest;
use App\Models\IutubeAccess;
use Illuminate\Http\Request;

class IUTubeAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("iutube index") ){
                return view("admin.iutube-access.index");
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
                return view("admin.iutube-access.create");
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
    public function store(IUTubeAccessCreateRequest $request)
    {
        try{
            if(auth()->user()->can("iutube create") ){
                $input = $request->all();
                $input["is_active"] = $request->boolean("is_active");
                IutubeAccess::add($input);
                toastr()->success("Успешно создан доступ к видео");
                return redirect()->route("iutube-access.index");
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
                $access = IutubeAccess::find($id);
                if($access){
                    return view("admin.iutube-access.edit",compact("access"));
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("iutube-access.index");
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
    public function update(IUTubeAccessEditRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("iutube edit") ){
                $access = IutubeAccess::find($id);
                if($access){
                    $input = $request->all();
                    $input["is_active"] = $request->boolean("is_active");
                    $access->edit($input);
                    toastr()->success("Успешно обновлен доступ");
                    return redirect()->route("iutube-access.index");
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("iutube-access.index");
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
                $access = IutubeAccess::find($id);
                if($access){
                    $access->delete();
                    toastr()->success("Успешно удален доступ");
                    return redirect()->route("iutube-access.index");
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("iutube-access.index");
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
