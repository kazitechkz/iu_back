<?php

namespace App\Events;

use App\Models\Battle;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BattleAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public Battle $battle;
    /**
     * Create a new event instance.
     */
    public function __construct(Battle $battle)
    {
        $this->battle = $battle;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            'battle-list-added',
        ];
    }

    public function broadcastAs()
    {
        return 'BattleAdded';
    }
}
