<?php

namespace App\Services;

use App\DTOs\ForumCreateDTO;
use App\Models\Forum;

class ForumService
{
    public function createForum(ForumCreateDTO $forumDTO){
        $user = auth()->guard("api")->user();
        $forumDTO = $forumDTO->toArray();
        $forumDTO["user_id"] = $user->id;
        $forum = Forum::add($forumDTO);
        if ($forumDTO["files"]){
            foreach ($forumDTO["files"] as $file){

            }
        }


    }
}
