<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InformationCategory\InformationCategoryCreateRequest;
use App\Http\Requests\InformationCategory\InformationCategoryEditRequest;
use App\Models\InformationCategory;
use ElForastero\Transliterate\Map;
use ElForastero\Transliterate\Transliterator;
use Illuminate\Http\Request;
class InformationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("information index") ){
                return view("admin.information-category.index");
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
                return view("admin.information-category.create");
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
    public function store(InformationCategoryCreateRequest $request)
    {
        try{
            if(auth()->user()->can("information create") ){
                $input = $request->all();
                $transliterator = new Transliterator(Map::LANG_RU, Map::GOST_7_79_2000);
                $input["alias"] = $transliterator->slugify($input["title_ru"]);
                InformationCategory::add($input);
                toastr()->success("Успешно создана категория");
                return redirect()->route("information-category.index");
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
                $informationCategory = InformationCategory::find($id);
                if($informationCategory){
                    return view("admin.information-category.edit",compact("informationCategory"));
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
    public function update(InformationCategoryCreateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("information edit") ){
                $informationCategory = InformationCategory::find($id);
                if($informationCategory){
                    $input = $request->all();
                    $transliterator = new Transliterator(Map::LANG_RU, Map::GOST_7_79_2000);
                    $input["alias"] = $transliterator->slugify($input["title_ru"]);
                    $informationCategory->edit($input);
                    toastr()->success("Успешно обновлена категория");
                    return redirect()->route("information-category.index");
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("information-category.index");
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
                $informationCategory = InformationCategory::find($id);
                if($informationCategory){
                    $informationCategory->delete();
                    toastr()->success("Успешно удалена категория");
                    return redirect()->route("information-category.index");
                }
                else{
                    toastr()->warning(__("message.not_found"));
                    return redirect()->route("information-category.index");
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
