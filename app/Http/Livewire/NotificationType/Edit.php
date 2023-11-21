<?php

namespace App\Http\Livewire\NotificationType;

use App\Http\Requests\NotificationType\NotificationTypeUpdateRequest;
use App\Models\Notification;
use App\Models\NotificationType;
use Livewire\Component;

class Edit extends Component
{
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $value;
    public $notificationType;
    public function mount(NotificationType $notificationType){
        $this->$notificationType = $notificationType;
        $this->title_ru = $this->$notificationType->title_ru ?? "";
        $this->title_kk = $this->$notificationType->title_kk ?? "";
        $this->title_en = $this->$notificationType->title_en ?? "";
        $this->value = $this->$notificationType->value ?? "";
    }
    protected function rules(){
        return (new NotificationTypeUpdateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.notification-type.edit');
    }
}
