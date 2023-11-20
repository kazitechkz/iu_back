<?php

namespace App\Http\Livewire\AnnouncementGroup;

use App\Http\Requests\AnnouncementGroup\AnnouncementGroupCreateRequest;
use Livewire\Component;

class Create extends Component
{
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $is_active;
    public $thumbnail;
    public $start_date;
    public $end_date;
    public $order;


    public function mount(){
        $this->title_ru = old("title_ru") ?? "";
        $this->title_kk = old("title_kk") ?? "";
        $this->title_en = old("title_en") ?? "";
        $this->is_active = old("is_active") ?? "";
        $this->thumbnail = old("thumbnail") ?? 0;
        $this->start_date = old("start_date") ?? "";
        $this->end_date = old("end_date") ?? "";
        $this->order = old("order") ?? "";

    }
    protected function rules(){
        return (new AnnouncementGroupCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.announcement-group.create');
    }
}
