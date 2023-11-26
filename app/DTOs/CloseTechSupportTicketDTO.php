<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class CloseTechSupportTicketDTO extends ValidatedDTO
{
    public $type_id;
    public $is_closed;
    public $is_resolved;
    protected function rules(): array
    {
        return [
            "ticket_id"=>"required|exists:tech_support_tickets,id",
            "is_closed"=>"required|boolean",
            "is_resolved"=>"required|boolean",
        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }
}
