<?php

namespace App\Http\Controllers\Api;

use App\DTOs\ForumCreateDTO;
use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request){
        try {
            $query = Forum::query()->withCount(["discusses","discuss_rating"]);
            if($request->has("type")){
                if ($request->get("type") == "popular"){
                    $query = $query->orderBy('discuss_rating_count', 'desc');
                }
                if ($request->get("type") == "discussed"){
                    $query = $query->orderBy('discusses_count', 'desc');
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

        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }


    }

}
