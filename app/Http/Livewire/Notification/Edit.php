<?php

namespace App\Http\Livewire\Notification;

use App\Http\Requests\Notification\NotificationUpdateRequest;
use App\Models\Notification;
use App\Models\NotificationType;
use Livewire\Component;

class Edit extends Component
{
    public Notification $notification;
    public $types;
    public $type_id;
    public $class_id;
    public $owner_id;
    public $users;
    public string $title;
    public string $message;

    public function mount(Notification $notification){
        $this->notification = $notification;
        $this->types = NotificationType::all();
        $this->title =$notification->title??"";
        $this->message = $notification->message??"";
        $this->type_id = $notification->type_id;
    }
    protected function rules(){
        $rules = (new NotificationUpdateRequest())->rules();
        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.notification.edit');
    }
}
