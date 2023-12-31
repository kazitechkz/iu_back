<?php

namespace App\Services;

use App\DTOs\ForumCreateDTO;
use App\Models\File;
use App\Models\Forum;
use App\Models\ForumFile;

class ForumService
{
    public function createForum(ForumCreateDTO $forumDTO){
        $user = auth()->guard("api")->user();
        $forumDTO = $forumDTO->toArray();
        $forumDTO["user_id"] = $user->id;
        $forum = Forum::add($forumDTO);
        return $forum;


    }
}
