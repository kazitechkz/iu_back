<?php

namespace App\Http\Livewire\Announcement;

use App\Http\Requests\Announcement\AnnouncementCreateRequest;
use App\Http\Requests\Announcement\AnnouncementUpdateRequest;
use App\Models\Announcement;
use App\Models\AnnouncementGroup;
use App\Models\AnnouncementType;
use App\Models\Group;
use Livewire\Component;

class Edit extends Component
{
    public Announcement $announcement;
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

    public function mount(Announcement $announcement){
        $this->groups = AnnouncementGroup::all();
        $this->types = AnnouncementType::all();
        $this->announcement = $announcement;
        $this->type_id = $announcement->type_id;
        $this->group_id = $announcement->group_id ?? "";
        $this->background = $announcement->background ?? 0;
        $this->title = $announcement->title ?? "";
        $this->sub_title = $announcement->sub_title ?? "";
        $this->description = $announcement->description ?? "";
        $this->time_in_sec = $announcement->time_in_sec ?? 0;
        $this->url_text = $announcement->url_text ?? "";
        $this->url = $announcement->url ?? "";
        $this->video_url = $announcement->video_url ?? "";
    }
    protected function rules(){
        return (new AnnouncementUpdateRequest())->rules();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.announcement.edit');
    }
}
