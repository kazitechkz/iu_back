<?php

namespace App\Http\Livewire\Statistic;

use App\Models\PayboxOrder;
use App\Models\Subject;
use Carbon\Carbon;
use Livewire\Component;

class OnOrder extends Component
{
    public $subjects;
    public $subjectID;
    public $date;
    public $orders = [];
    public bool $isInfoShow = false;

    public function mount()
    {
        $this->subjects = Subject::all();

    }

    public function updatedDate()
    {
        foreach ($this->subjects as $key => $value) {
            $this->orders[$key]['id'] = $value->id;
            $this->orders[$key]['title'] = $value->title_ru;
            $this->orders[$key]['count'] = $this->getOrderCounts($value->id, $this->date);
        }
        arsort($this->orders);
    }

    public function getInfo($subjectID)
    {
        $this->isInfoShow = true;
        $this->subjectID = $subjectID;
    }

    public function getOrderCounts($subjectID, $date = null): int
    {
        if ($date) {
            $count = PayboxOrder::where('status', 1)
                ->whereBetween('created_at', [Carbon::create($date)->startOfDay(), Carbon::create($date)->endOfDay()])
                ->whereJsonContains('subjects', intval($subjectID))
                ->count();
        } else {
            $count = PayboxOrder::where('status', 1)
                ->whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
                ->whereJsonContains('subjects', intval($subjectID))
                ->count();
        }
        return $count;
    }

    public function render()
    {
        return view('livewire.statistic.on-order');
    }
}
