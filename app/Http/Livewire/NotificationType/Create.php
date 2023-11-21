<?php

namespace App\Http\Livewire\NotificationType;

use App\Http\Requests\NotificationType\NotificationTypeCreateRequest;
use Livewire\Component;

class Create extends Component
{

    public $title_ru;
    public $title_kk;
    public $title_en;
    public $value;


    public function mount(){
        $this->title_ru = old("title_ru") ?? "";
        $this->title_kk = old("title_kk") ?? "";
        $this->title_en = old("title_en") ?? "";
        $this->value = old("value") ?? "";
    }
    protected function rules(){
        return (new NotificationTypeCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.notification-type.create');
    }
}
