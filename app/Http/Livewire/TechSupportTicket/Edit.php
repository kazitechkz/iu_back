<?php

namespace App\Http\Livewire\TechSupportTicket;

use App\Models\TechSupportMessage;
use App\Models\TechSupportTicket;
use Livewire\Component;

class Edit extends Component
{
    public $techSupportTicket;
    public $messages;
    public $message;
    public $ticket_id;
    public $is_closed;
    public $is_resolved;
    public function mount(TechSupportTicket $techSupportTicket){
        $this->techSupportTicket = $techSupportTicket;
        $this->messages = TechSupportMessage::where(["ticket_id" => $techSupportTicket->id])->orderBy("created_at","DESC")->get();
        $this->ticket_id = $techSupportTicket->id;
        $this->is_closed = $techSupportTicket->is_closed;
        $this->is_resolved = $techSupportTicket->is_resolved;
    }
    protected function rules(){
        return[
            "message"=>"required"
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.tech-support-ticket.edit');
    }
}
