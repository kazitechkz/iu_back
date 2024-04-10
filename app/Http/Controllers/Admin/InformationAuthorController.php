<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InformationAuthor\InformationAuthorCreateRequest;
use App\Http\Requests\InformationAuthor\InformationAuthorEditRequest;
use App\Models\InformationAuthor;
use App\Models\IutubeAccess;
use Illuminate\Http\Request;

class InformationAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("information index") ){
                return view("admin.information-author.index");
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
            if(auth()->user()->can("information create") ){
                return view("admin.information-author.create");
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
    public function store(InformationAuthorCreateRequest $request)
    {
        try{
            if(auth()->user()->can("information create") ){
                $input = $request->all();
                InformationAuthor::add($input);
                toastr()->success("Успешно создан автор");
                return redirect()->route("information-author.index");
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
            if(auth()->user()->can("information edit") ){
                $informationAuthor = InformationAuthor::find($id);
                if($informationAuthor){
                    return view("admin.information-author.edit",compact("informationAuthor"));
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("information-author.index");
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
    public function update(InformationAuthorEditRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("information edit") ){
                $informationAuthor = InformationAuthor::find($id);
                if($informationAuthor){
                    $input = $request->all();
                    $informationAuthor->edit($input);
                    toastr()->success("Успешно обновлен автор");
                    return redirect()->route("information-author.index");
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("information-author.index");
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
            if(auth()->user()->can("information edit") ){
                $informationAuthor = InformationAuthor::find($id);
                if($informationAuthor){
                    $informationAuthor->delete();
                    toastr()->success("Успешно удален автор");
                    return redirect()->route("information-author.index");
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("information-author.index");
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
