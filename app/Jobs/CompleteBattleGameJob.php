<?php

namespace App\Jobs;

use App\Models\Battle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\BattleService;
class CompleteBattleGameJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $battle_id;
    public function __construct($battle_id)
    {
        $this->battle_id = $battle_id;
    }

    /**
     * Execute the job.
     */
    public function handle(BattleService $battleService): void
    {
         $battleService->battleTimeOut($this->battle_id);
    }
}
