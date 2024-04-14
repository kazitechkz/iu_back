<?php

namespace App\Http\Livewire\AdminDashboard;

use App\Models\PayboxOrder;
use App\Models\Subject;
use Bpuig\Subby\Models\Plan;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class GetSubjectStats extends Component
{
    use WithPagination;
    public $perPage = 10;
    public bool $isSearch = false;
    public $date;
    public $subjects;
    public $subjectId = 0;
    public $subjectTitle;
    public $subjectImg;
    public $countOrders;
    public $priceOrders;
    public $grantPrice;
    public $percentage;
    public $cash;


    public function mount($subjectID, $date)
    {
        $this->subjectId = $subjectID;
        $this->date = $date;
    }

    public function loadMore(): void
    {
        $this->perPage += 10;
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

    public function render()
    {
        $orders = [];
        if ($this->subjectId != 0) {
            $this->isSearch = true;
            $subject = Subject::with('image')->find($this->subjectId);
            $this->subjectTitle = $subject->title_ru;
            $this->subjectImg = $subject->image->url;
            $this->percentage = $this->getPercentage($this->subjectId);
            $orders = PayboxOrder::where('status', 1)
                ->whereBetween('created_at', [Carbon::create($this->date)->startOfDay(), Carbon::create($this->date)->endOfDay()])
                ->whereJsonContains('subjects', intval($this->subjectId))
                ->get();
            $this->countOrders = $orders->count();
            $this->priceOrders = $orders->sum('price');
            $this->grantPrice = round(0.2 * $this->priceOrders);
            $this->cash = round(($this->grantPrice*$this->percentage)/100);
            $orders = PayboxOrder::with('user')
                ->where('status', 1)
                ->whereBetween('created_at', [Carbon::create($this->date)->startOfDay(), Carbon::create($this->date)->endOfDay()])
                ->whereJsonContains('subjects', intval($this->subjectId))
                ->latest()
                ->paginate($this->perPage);
        } else {
            $this->isSearch = false;
        }
        return view('livewire.admin-dashboard.get-subject-stats', ['orders' => $orders]);
    }
}
