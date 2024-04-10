<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Information\InformationCreateRequest;
use App\Models\Information;
use ElForastero\Transliterate\Map;
use ElForastero\Transliterate\Transliterator;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("information index") ){
                return view("admin.information.index");
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
                return view("admin.information.create");
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
    public function store(InformationCreateRequest $request)
    {
        try{
            if(auth()->user()->can("information create") ){
                $input = $request->all();
                $transliterator = new Transliterator(Map::LANG_RU, Map::GOST_7_79_2000);
                $input["alias"] = $transliterator->slugify($input["title_ru"]);
                $input["is_main"] = $request->boolean("is_main");
                $input["is_active"] = $request->boolean("is_active");
                Information::add($input);
                toastr()->success("Успешно создана новость");
                return redirect()->route("information.index");
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
                $information = Information::find($id);
                if($information){
                    return view("admin.information.edit",compact("information"));
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
    public function update(InformationCreateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("information edit") ){
                $information = Information::find($id);
                if($information){
                    $input = $request->all();
                    $transliterator = new Transliterator(Map::LANG_RU, Map::GOST_7_79_2000);
                    $input["alias"] = $transliterator->slugify($input["title_ru"]);
                    $input["is_main"] = $request->boolean("is_main");
                    $input["is_active"] = $request->boolean("is_active");
                    $information->edit($input);
                    toastr()->success("Успешно обновлена новость");
                    return redirect()->route("information.index");
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("information.index");
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
                $information = Information::find($id);
                if($information){
                    $information->delete();
                    toastr()->success("Успешно удалена новость");
                    return redirect()->route("information.index");
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("information.index");
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
