<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function importantNews(){
        try{
            $news = News::where(["is_important" => true,"is_active" => true])->with(["image","poster","locale","user"])->orderBy('published_at', 'DESC')->first();
            return response()->json(new ResponseJSON(status: true,data: $news),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function singleNews($id){
        try{
            $news = News::where(["id"=>$id])->with(["image","poster","locale","user"])->first();
            return response()->json(new ResponseJSON(status: true,data: $news),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }


    public function news(Request $request){
        try{
            $important =  News::where(["is_important" => true,"is_active" => true])->with(["image","poster","locale","user"])->orderBy('published_at', 'DESC')->first();
            $news = News::where(["is_active" => true,]);
            if($important){
                $news = $news->where("id","!=",$important->id);
            }
            $news = $news->with(["image","poster","locale","user"])->orderBy('published_at', 'DESC')->paginate(12);
            return response()->json(new ResponseJSON(status: true,data: $news),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
