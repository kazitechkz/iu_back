<?php

namespace App\Http\Livewire\Discuss;

use App\Http\Requests\Discuss\DiscussCreateRequest;
use App\Http\Requests\Forum\ForumCreateRequest;
use App\Http\Requests\Group\GroupCreateRequest;
use App\Models\Forum;
use Bpuig\Subby\Models\Plan;
use Livewire\Component;

class Create extends Component
{
    public int|null $forum_id;
    public string|null $text;
    public $forums;
    public $forum;


    public function mount(Forum $forum){
        $this->forum = $forum;
        $this->forums = $forum ? Forum::where("id",$forum->id)->get() : Forum::all();
        $this->text = old("text") ?? "";
        $this->forum_id = $this->forum->id;
    }
    protected function rules(){
        return (new DiscussCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }



    public function render()
    {
        return view('livewire.discuss.create');
    }
}
