<?php

namespace App\Http\Livewire\Statistic;

use App\Models\PayboxOrder;
use App\Models\Subject;
use Bpuig\Subby\Models\Plan;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class OnOrderBySubjects extends Component
{
    use WithPagination;
    public $perPage = 20;
    public bool $isSearch = false;
    public $date;
    public $subjects;
    public $subjectId;
    public $subjectTitle;
    public $subjectImg;
    public $countOrders;
    public $priceOrders;
    public $grantPrice;
    public $percentage;
    public $cash;
    public $subjectID;
    public $allOrders = [];
    public $orders = [];
    public bool $isInfoShow = false;

    public function mount()
    {
        $this->subjects = Subject::all();
        foreach ($this->subjects as $key => $value) {
            $this->allOrders[$key]['id'] = $value->id;
            $this->allOrders[$key]['title'] = $value->title_ru;
            $this->allOrders[$key]['count'] = $this->getOrderCounts($value->id);
        }
    }
    public function loadMore(): void
    {
        $this->perPage += 10;
        $this->getInfo($this->subjectId);
    }
    public function getPercentage($subjectID): float
    {
        if ($subjectID == 1 || $subjectID == 3) {
            $percentage = 8.33;
        } elseif ($subjectID == 2) {
            $percentage = 16.66;
        } else {
            $percentage = 33.33;
        }
        return $percentage;
    }
    public function getPlanTitle($planID): string
    {
        $title = '';
        $plan = Plan::find($planID);
        if ($plan) {
            switch ($plan->invoice_period) {
                case 1:
                    $title = 'Базовый тариф';
                    break;
                case 3:
                    $title = 'Стандартный тариф';
                    break;
                case 6:
                    $title = 'Премиум тариф';
                    break;
            }
        }
        return $title;
    }
    public function updatedDate()
    {
        foreach ($this->subjects as $key => $value) {
            $this->allOrders[$key]['id'] = $value->id;
            $this->allOrders[$key]['title'] = $value->title_ru;
            $this->allOrders[$key]['count'] = $this->getOrderCounts($value->id, $this->date);
        }
        arsort($this->allOrders);
        if ($this->subjectId) {
            $this->getInfo($this->subjectId, $this->date);
        }
    }

    public function getInfo($subjectID, $date = null)
    {
        $this->subjectId = $subjectID;
        $this->isInfoShow = true;
        $subject = Subject::with('image')->find($subjectID);
        $this->subjectTitle = $subject->title_ru;
        $this->subjectImg = $subject->image->url;
        $this->percentage = $this->getPercentage($subjectID);
        if ($date) {
            $date = $this->date;
            $old_orders = PayboxOrder::where('status', 1)
                ->whereBetween('created_at', [Carbon::create($date)->startOfDay(), Carbon::create($date)->endOfDay()])
                ->whereJsonContains('subjects', intval($subjectID))
                ->get();
            $this->countOrders = $old_orders->count();
            $this->priceOrders = $old_orders->sum('price');
            $this->grantPrice = round(0.2 * $this->priceOrders);
            $this->cash = round(($this->grantPrice*$this->percentage)/100);
            $orders = PayboxOrder::with('user')
                ->where('status', 1)
                ->whereBetween('created_at', [Carbon::create($date)->startOfDay(), Carbon::create($date)->endOfDay()])
                ->whereJsonContains('subjects', intval($subjectID))
                ->latest()
                ->take($this->perPage)
                ->get();
            $this->orders = $orders;
        } else {
            $old_orders = PayboxOrder::where('status', 1)
                ->whereJsonContains('subjects', intval($subjectID))
                ->get();
            $this->countOrders = $old_orders->count();
            $this->priceOrders = $old_orders->sum('price');
            $this->grantPrice = round(0.2 * $this->priceOrders);
            $this->cash = round(($this->grantPrice*$this->percentage)/100);
            $orders = PayboxOrder::with('user')
                ->where('status', 1)
                ->whereJsonContains('subjects', intval($subjectID))
                ->latest()
                ->take($this->perPage)
                ->get();
            $this->orders = $orders;
        }
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
                ->whereJsonContains('subjects', intval($subjectID))
                ->count();
        }
        return $count;
    }

    public function render()
    {
        return view('livewire.statistic.on-order-by-subject');
    }
}
