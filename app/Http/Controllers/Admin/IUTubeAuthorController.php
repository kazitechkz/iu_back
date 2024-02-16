<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IUTubeAuthor\IUTubeAuthorCreateRequest;
use App\Http\Requests\IUTubeAuthor\IUTubeAuthorEditRequest;
use App\Models\IutubeAuthor;
use Illuminate\Http\Request;

class IUTubeAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("iutube index") ){
                return view("admin.iutube-author.index");
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
                return view("admin.iutube-author.create");
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
    public function store(IUTubeAuthorCreateRequest $request)
    {
        try{
            if(auth()->user()->can("iutube create") ){
                $input = $request->all();
                $input["is_active"] = $request->boolean("is_active");
                IutubeAuthor::add($input);
                toastr()->success("Успешно создан автор канала");
                return redirect()->route("iutube-author.index");
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
            if(auth()->user()->can("iutube show") ){

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
            if(auth()->user()->can("iutube edit") ){
                $author = IutubeAuthor::with("file")->find($id);
                if($author){
                    return view("admin.iutube-author.edit",compact("author"));
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("iutube-author.index");
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
    public function update(IUTubeAuthorEditRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("iutube edit") ){
                $author = IutubeAuthor::with("file")->find($id);
                if($author){
                    $input = $request->all();
                    $input["is_active"] = $request->boolean("is_active");
                    $author->edit($input);
                    toastr()->success("Успешно обновлен автор канала");
                    return redirect()->route("iutube-author.index");
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("iutube-author.index");
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
                $author = IutubeAuthor::with("file")->find($id);
                if($author){
                    $author->delete();
                    toastr()->success("Успешно удален автор канала");
                    return redirect()->route("iutube-author.index");
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("iutube-author.index");
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
