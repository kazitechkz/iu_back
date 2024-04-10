<?php

namespace App\Http\Livewire\Announcement;

use App\Http\Requests\Announcement\AnnouncementCreateRequest;
use App\Http\Requests\AnnouncementGroup\AnnouncementGroupCreateRequest;
use App\Models\AnnouncementGroup;
use App\Models\AnnouncementType;
use Livewire\Component;

class Create extends Component
{
    public $types;
    public $groups;
    public $type_id;
    public $group_id;
    public $background;
    public $title;
    public $sub_title;
    public $description;
    public $time_in_sec;
    public $url_text;
    public $url;
    public $video_url;

    public function mount(){
        $this->groups = AnnouncementGroup::all();
        $this->types = AnnouncementType::all();
        $this->type_id = old("type_id") ?? "";
        $this->group_id = old("group_id") ?? "";
        $this->background = old("background") ?? 0;
        $this->title = old("title") ?? "";
        $this->sub_title = old("sub_title") ?? "";
        $this->description = old("description") ?? "";
        $this->time_in_sec = old("time_in_sec") ?? 0;
        $this->url_text = old("url_text") ?? "";
        $this->url = old("url") ?? "";
        $this->video_url = old("video_url") ?? "";
    }
    protected function rules(){
        return (new AnnouncementCreateRequest())->rules();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.announcement.create');
    }
}
