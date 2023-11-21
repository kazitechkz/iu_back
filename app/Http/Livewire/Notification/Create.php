<?php

namespace App\Http\Livewire\Notification;
use App\Http\Requests\Notification\NotificationCreateRequest;
use App\Models\NotificationType;
use Livewire\Component;

class Create extends Component
{
    public $types;
    public $type_id;
    public $class_id;
    public $owner_id;
    public $users;
    public string $title;
    public string $message;

    public function mount(){
        $this->types = NotificationType::all();
        $this->title = old("title")??"";
        $this->type_id = old("type_id");
        $this->message = old("message")??"";
    }
    protected function rules(){
        $rules = (new NotificationCreateRequest())->rules();
        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.notification.create');
    }
}
