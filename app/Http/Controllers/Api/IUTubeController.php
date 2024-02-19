<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IutubeAccess;
use App\Models\IutubeAuthor;
use App\Models\IutubeVideo;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;
use Mockery\Exception;

class IUTubeController extends Controller
{
    public function getMainVideos(){
        try {
            $accessSubjectId = IutubeAccess::where(["is_active" => true])->pluck("subject_id")->toArray();
            $recommended = IutubeVideo::whereIn("subject_id",$accessSubjectId)->with(["iutube_author.file","file","locale","step","sub_step","subject"])->where(["is_public" => true,"is_recommended" => true])->inRandomOrder()->take(12)->get();
            $public_videos = IutubeVideo::whereIn("subject_id",$accessSubjectId)->with(["iutube_author.file","file","locale","step","sub_step","subject"])->where(["is_public" => true,"is_recommended" => false])->inRandomOrder()->take(12)->get();
            return response()->json(new ResponseJSON(status: true,data: ["recommended"=>$recommended,"public_videos"=>$public_videos]),200);
        }
        catch (Exception $exception){
            return ResponseService::DefineException($exception);
        }
    }

    public function getListVideos(Request $request){
        try {
            $accessSubjectId = IutubeAccess::where(["is_active" => true])->pluck("subject_id")->toArray();
            $whereCondition = ["is_public"=>true];
            $rawRequest =  IutubeVideo::whereIn("subject_id",$accessSubjectId)->with(["iutube_author.file","file","locale","step","sub_step","subject"])->query();
            if($request->get("subject_id")){
                $whereCondition["subject_id"] = $request->get("subject_id");
            }
            if($request->get("locale_id")){
                $whereCondition["locale_id"] = $request->get("locale_id");
            }
            if(count($whereCondition)){
                $rawRequest = $rawRequest->where($whereCondition);
            }
            if($request->get("search")){
                $rawRequest = $rawRequest->where('name', 'like', '%' . $request->get("search") . '%');
            }
            $result = $rawRequest->latest()->paginate(15);
            return response()->json(new ResponseJSON(status: true,data: $result),200);

        }
        catch (Exception $exception){
            return ResponseService::DefineException($exception);
        }
    }

    public function getAuthorDetail($id,Request $request){
        try {
            $author = IutubeAuthor::where(["id"=>$id,"is_active" => true])->first();
            if(!$author){
                return ResponseService::NotFound("Не найден автор");
            }
            $videos = IutubeVideo::with(["iutube_author.file","file","locale","step","sub_step","subject"])->where(["author_id" => $id])->paginate(12);
            return response()->json(new ResponseJSON(status: true,data: ["author"=>$author,"videos"=>$videos]),200);
        }
        catch (Exception $exception){
            return ResponseService::DefineException($exception);
        }
    }

    public function getSingleVideo($alias){
        try {
            $accessSubjectId = IutubeAccess::where(["is_active" => true])->pluck("subject_id")->toArray();
            $video = IutubeVideo::whereIn("subject_id",$accessSubjectId)->where(["is_public"=>true,"alias"=>$alias])->with(["iutube_author.file","file","locale","step","sub_step","subject"])->first();
            if(!$video){
                return ResponseService::NotFound("Не найдено видео");
            }
            $also_recommended = IutubeVideo::where("id","!=",$video->id)->where(["is_public" => true])->with(["iutube_author.file","file","locale","step","sub_step","subject"])->inRandomOrder()->take(5)->get();
            return response()->json(new ResponseJSON(status: true,data:["video"=>$video,"also_recommended"=>$also_recommended]),200);
        }
        catch (Exception $exception){
            return ResponseService::DefineException($exception);
        }
    }
}
