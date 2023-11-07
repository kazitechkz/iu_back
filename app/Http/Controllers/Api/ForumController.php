<?php

namespace App\Http\Controllers\Api;

use App\DTOs\ForumCreateDTO;
use App\Http\Controllers\Controller;
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
            $query = Forum::query()->with(["user","subject"])->withCount(["discusses","discuss_rating"]);
            if($request->get("subject_id")){
                $query = $query->where(["subject_id"=>$request->get("subject_id")]);
            }
            if($request->hasAny("type")){
                if ($request->get("type") == "popular"){
                    $query = $query->orderBy('discuss_rating_count', 'desc');
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

}
