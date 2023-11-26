<?php

namespace App\Services;

use App\DTOs\CloseTechSupportTicketDTO;
use App\DTOs\CreateTechSupportMessageDTO;
use App\DTOs\CreateTechSupportTicketDTO;
use App\Models\TechSupportFile;
use App\Models\TechSupportMessage;
use App\Models\TechSupportTicket;
use PHPUnit\Framework\Attributes\Ticket;

class TechSupportService
{
    public function createTechSupportTicket($request){
        $user = auth()->guard("api")->user();
        $createTechSupportTicketDTO = CreateTechSupportTicketDTO::fromRequest($request);
        $data = $createTechSupportTicketDTO->toArray();
        $data["user_id"] = $user->id;
        $ticket = TechSupportTicket::add($data);
        if($ticket){
          $ticketMessage =  TechSupportMessage::add([
                'ticket_id'=>$ticket->id,
                'user_id'=>$user->id,
                'message'=>$data["message"]
            ]);
          if($ticketMessage){
              if($data["files"]){
                  foreach ($data["files"] as $file){
                    TechSupportFile::add([
                        'message_id' => $ticketMessage->id,
                        'file_url' => $file
                    ]);
                  }
              }
          }
        }
        return $ticket;
    }
    public function createTechSupportMessage($request){
        $user = auth()->guard("api")->user();
        $createTechSupportMessageDTO = CreateTechSupportMessageDTO::fromRequest($request);
        if($ticket = TechSupportTicket::find($request->get("ticket_id"))){
            if($ticket->user_id != $user->id || $ticket->is_closed){
                throw new \Exception("У вас нет прав!");
            }
        }
        $data = $createTechSupportMessageDTO->toArray();
        $data["user_id"] = $user->id;
        $ticketMessage =  TechSupportMessage::add($data);
        if($data["files"]){
            foreach ($data["files"] as $file){
                TechSupportFile::add([
                    'message_id' => $ticketMessage->id,
                    'file_url' => $file
                ]);
            }
        }
        return $ticketMessage;
    }


    public function closeTicket($request){
        $user = auth()->guard("api")->user();
        $closeTicketDTO = CloseTechSupportTicketDTO::fromRequest($request);
        if($ticket = TechSupportTicket::find($request->get("ticket_id"))){
            if($ticket->user_id != $user->id || $ticket->is_closed){
                throw new \Exception("У вас нет прав!");
            }
        }
        $data = $closeTicketDTO->toArray();
        $ticket->edit($data);
        return $ticket;
    }
}
