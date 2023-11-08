<?php

namespace App\Http\Controllers\Api;

use App\DTOs\ForumCreateDTO;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Discuss;
use App\Models\DiscussRating;
use App\Models\Forum;
use App\Services\ForumService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    private ForumService $_forumService;
    public function __construct(ForumService $forumService){
        $this->_forumService = $forumService;
    }
    public function index(Request $request){
        try {
            $query = Forum::query()->with(["user","subject"])->withCount(["discusses"])->withSum("discuss_rating","rating");
            if($request->get("subject_id")){
                $query = $query->where(["subject_id"=>$request->get("subject_id")]);
            }
            if($request->get("search")){
                $query = $query->where('text', 'LIKE', "%{$request->get("search")}%")->orWhere('attachment', 'LIKE', "%{$request->get("search")}%");
            }
            if($request->hasAny("type")){
                if ($request->get("type") == "popular"){
                    $query = $query->orderBy('discuss_rating_sum_rating', 'desc');
                }
                if ($request->get("type") == "discussed"){
                    $query = $query->orderBy('discusses_count', 'desc');
                }
                else{
                    $query = $query->orderBy('created_at', 'desc');
                }
            }
            else{
                $query = $query->orderBy('created_at', 'desc');
            }
            $forums = $query->paginate(15);
            return response()->json(new ResponseJSON(status: true,data: $forums),200);

        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }
    }


    public function createForum(Request $request){
        try {
            $forum_dto = ForumCreateDTO::fromRequest($request);
            $forum = $this->_forumService->createForum($forum_dto);
            return response()->json(new ResponseJSON(status: true,data: $forum),200);
        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }
    }

    public function show($id){
        try {
            $forum = Forum::with(["user","subject"])->withCount(["discusses"])->withSum("discuss_rating","rating")->find($id);
            if(!$forum){
                throw new NotFoundException();
            }
            $rating = DiscussRating::where(["forum_id" => $id,"discuss_id" => null,"user_id" => auth()->guard("api")->id()])->first();
            return response()->json(new ResponseJSON(status: true,data: ['forum'=>$forum,"rating"=>$rating]),200);
        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }
    }

    public function forumDiscuss(Request $request,$forum_id){
        try {
            $discusses = Discuss::query()->where(["forum_id" => $forum_id])->with(["user"])->
            withSum(["discuss_ratings"=>fn ($query) => $query->where('discuss_id', null)],"rating");
            if ($request->get("type") == "popular"){
                $discusses = $discusses->orderBy('discuss_rating_sum_ratings', 'desc');
            }
            else{
                $discusses = $discusses->orderBy('created_at', 'desc');
            }
            $discusses = $discusses->paginate(12);
            $ratings = DiscussRating::where(["forum_id" => $forum_id,"user_id" => auth()->guard("api")->id()])->get();
            return response()->json(new ResponseJSON(status: true,data: ["discusses"=>$discusses,"ratings"=>$ratings]),200);
        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }
    }

    public function ratingForumOrDiscuss(Request $request){
        try {
            $user_rating = $request->get("rating") ?? 0;
            if($user_rating < -1 || $user_rating > 1){
                $user_rating = 0;
            }
            if($request->get("forum_id")){
                $forum = Forum::find($request->get("forum_id"));
                if(!$forum){
                    throw new NotFoundException();
                }
                $rating = DiscussRating::where(["forum_id" => $request->get("forum_id"),"discuss_id" => null,"user_id" => auth()->guard("api")->id()])->first();
                if($rating){
                    $rating->update(["rating"=>$user_rating]);
                }
                else{
                    $rating = DiscussRating::add(["forum_id" => $request->get("forum_id"),"discuss_id" => null,"user_id" => auth()->guard("api")->id(),"rating"=>$user_rating]);
                }
            }
            if($request->get("discuss_id")){
                $discuss = Discuss::find($request->get("discuss_id"));
                if(!$discuss){
                    throw new NotFoundException();
                }
                $rating = DiscussRating::where(["forum_id" => $request->get("forum_id"),"discuss_id" => $discuss->id,"user_id" => auth()->guard("api")->id()])->first();
                if($rating){
                    $rating->update(["rating"=>$user_rating]);
                }
                else{
                    $rating = DiscussRating::add(["forum_id" => $request->get("forum_id"),"discuss_id" => $discuss->id,"user_id" => auth()->guard("api")->id(),"rating"=>$user_rating]);
                }
            }
            return response()->json(new ResponseJSON(status: true,data: $rating),200);
        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }
    }



}
