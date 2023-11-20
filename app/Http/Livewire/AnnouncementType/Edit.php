<?php

namespace App\Http\Livewire\AnnouncementType;

use App\Http\Requests\AnnouncementType\AnnouncementTypeUpdateRequest;
use App\Http\Requests\Gender\GenderUpdateRequest;
use App\Models\AnnouncementType;
use App\Models\Gender;
use Livewire\Component;

class Edit extends Component
{
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $announcementType;
    public $gender;
    public function mount(AnnouncementType $announcementType){
        $this->announcementType = $announcementType;
        $this->title_ru = $this->announcementType->title_ru ?? "";
        $this->title_kk = $this->announcementType->title_kk ?? "";
        $this->title_en = $this->announcementType->title_en ?? "";
    }
    protected function rules(){
        return (new AnnouncementTypeUpdateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.announcement-type.edit');
    }
}
