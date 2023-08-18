<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsCreateRequest;
use App\Http\Requests\News\NewsUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.news.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.news.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsCreateRequest $request)
    {

        $input = $request->all();
        $input["is_active"] = $request->boolean("is_active");
        $input["is_important"] = $request->boolean("is_important");
        $input["published_by"] = auth()->id();
        $input["published_at"] = Carbon::parse($input["published_at"]);
        News::add($input);
        return redirect()->route("news.index");

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
        $news = News::find($id);
        if($news){
          return view("admin.news.edit",compact("news"));
        }
        return redirect()->route("news.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsUpdateRequest $request, string $id)
    {
        $news = News::find($id);
        if($news){
            $input = $request->all();
            $input["is_active"] = $request->boolean("is_active");
            $input["is_important"] = $request->boolean("is_important");
            $input["published_by"] = auth()->id();
            $input["published_at"] = Carbon::parse($input["published_at"]);
            $news->update($input);
        }
        return redirect()->route("news.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
