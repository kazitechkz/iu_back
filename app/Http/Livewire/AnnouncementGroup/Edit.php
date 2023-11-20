<?php

namespace App\Http\Livewire\AnnouncementGroup;

use App\Http\Requests\AnnouncementGroup\AnnouncementGroupCreateRequest;
use App\Http\Requests\AnnouncementGroup\AnnouncementGroupUpdateRequest;
use App\Models\AnnouncementGroup;
use App\Models\AnnouncementType;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Edit extends Component
{
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $is_active;
    public $thumbnail;
    public $start_date;
    public $end_date;
    public $order;
    public $announcementGroup;

    public function mount(AnnouncementGroup $announcementGroup){
        $this->title_ru = $announcementGroup->title_ru;
        $this->title_kk = $announcementGroup->title_kk;
        $this->title_en = $announcementGroup->title_en;
        $this->is_active = $announcementGroup->is_active;
        $this->thumbnail = $announcementGroup->thumbnail;
        $this->start_date = $announcementGroup->start_date ? $announcementGroup->start_date->format("DD-MM-YYYY HH:mm") :'';
        $this->end_date = $announcementGroup->end_date ? $announcementGroup->end_date->format("DD-MM-YYYY HH:mm") :'';
        $this->order = $announcementGroup->order;

    }
    protected function rules(){
        return (new AnnouncementGroupUpdateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.announcement-group.edit');
    }
}
