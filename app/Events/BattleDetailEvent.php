<?php

namespace App\Events;

use App\Models\Battle;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BattleDetailEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $promo_code;

    public function __construct($promo_code)
    {
        $this->promo_code = $promo_code;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            'battle-channel.' . $this->promo_code,
        ];
    }

    public function broadcastAs()
    {
        return 'BattleDetailEvent';
    }
}
