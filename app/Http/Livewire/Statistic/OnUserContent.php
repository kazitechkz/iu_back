<?php

namespace App\Http\Livewire\Statistic;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OnUserContent extends Component
{
    public $stats;
    public $date;
    public $time;
    public function mount()
    {
        $this->stats = User::role(['method', 'assist'])->with(['stats_by_questions', 'stats_by_contents'])->get();
    }

    public function updatedDate()
    {
        $date = $this->date;
        $this->stats = User::role(['method', 'assist'])->with([
            'stats_by_questions' => function($query) use ($date){
                $query->whereBetween('created_at', [Carbon::create($date)->startOfDay(), Carbon::create($date)->endOfDay()]);
            },
            'stats_by_contents' => function($query) use ($date){
                $query->whereBetween('created_at', [Carbon::create($date)->startOfDay(), Carbon::create($date)->endOfDay()]);
            }
        ])->get();
    }

    public function updatedTime()
    {
        $time = $this->time;
        if ($time == 1) {
            $this->stats = User::role(['method', 'assist'])->with([
                'stats_by_questions', 'stats_by_contents'
            ])->get();
        } elseif ($time == 2) {
            $this->stats = User::role(['method', 'assist'])->with([
                'stats_by_questions' => function($query) use ($time){
                    $query->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()]);
                },
                'stats_by_contents' => function($query) use ($time){
                    $query->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()]);
                }
            ])->get();
        } elseif ($time == 3) {
            $this->stats = User::role(['method', 'assist'])->with([
                'stats_by_questions' => function($query) use ($time){
                    $query->whereBetween('created_at', [Carbon::today()->subWeek()->startOfDay(), Carbon::today()->endOfDay()]);
                },
                'stats_by_contents' => function($query) use ($time){
                    $query->whereBetween('created_at', [Carbon::today()->subWeek()->startOfDay(), Carbon::today()->endOfDay()]);
                }
            ])->get();
        } elseif ($time == 4) {
            $this->stats = User::role(['method', 'assist'])->with([
                'stats_by_questions' => function($query) use ($time){
                    $query->whereBetween('created_at', [Carbon::today()->subMonth()->startOfDay(), Carbon::today()->endOfDay()]);
                },
                'stats_by_contents' => function($query) use ($time){
                    $query->whereBetween('created_at', [Carbon::today()->subMonth()->startOfDay(), Carbon::today()->endOfDay()]);
                }
            ])->get();
        }
    }
    public function render()
    {
        return view('livewire.statistic.on-user-content');
    }
}
