<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subcategory\SubcategoryCreate;
use App\Models\MethodistContentStat;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $model = SubCategory::class;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("subcategories index") ){
                return view('admin.sub-category.index');
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
            if(auth()->user()->can("subcategories create") ){
                return view('admin.sub-category.create');
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
    public function store(SubcategoryCreate $request)
    {
        try{
            if(auth()->user()->can("subcategories create") ){
                $sub_category = SubCategory::add($request->all());
                if($sub_category){
                    MethodistContentStat::add(["created_user"=>auth()->id(),"sub_category_id"=>$sub_category->id]);
                }
                return redirect(route('sub-categories.index'));
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
            if(auth()->user()->can("subcategories show") ){
                return view('admin.sub-category.create');
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
            if(auth()->user()->can("subcategories edit") ){
                $subCategory = SubCategory::findOrFail($id);
                return view('admin.sub-category.edit', compact('subCategory'));
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
    public function update(SubcategoryCreate $request, string $id)
    {
        try{
            if(auth()->user()->can("subcategories edit") ){
                $cat = SubCategory::findOrFail($id);
                $cat->edit($request->all());
                if($cat){
                    $stat = MethodistContentStat::where(["sub_category_id" => $cat->id])->first();
                    if($stat){
                        $stat->edit(["updated_user"=>auth()->id()]);
                    }
                    else{
                        MethodistContentStat::add(["updated_user"=>auth()->id(),"sub_category_id"=>$cat->id]);
                    }
                }
                return redirect(route('sub-categories.index'));
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
        //
    }
}
