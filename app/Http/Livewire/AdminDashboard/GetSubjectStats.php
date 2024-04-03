<?php

namespace App\Http\Livewire\AdminDashboard;

use App\Models\PayboxOrder;
use App\Models\Subject;
use Carbon\Carbon;
use Livewire\Component;

class GetSubjectStats extends Component
{
    public bool $isSearch = false;
    public $from;
    public $to;
    public $subjects;
    public $subjectId;
    public $subjectTitle;
    public $subjectImg;
    public $countOrders;
    public $priceOrders;
    public $grantPrice;
    public $percentage;
    public $cash;


    public function mount()
    {
        $this->subjects = Subject::all();
        $this->to = Carbon::today()->endOfDay();
    }


    public function searchStats(): void
    {
        if ($this->subjectId != 0) {
            $this->isSearch = true;
            $subject = Subject::with('image')->find($this->subjectId);
            $this->subjectTitle = $subject->title_ru;
            $this->subjectImg = $subject->image->url;
            $this->percentage = $this->getPercentage($this->subjectId);
            if ($this->from && Carbon::create($this->from) < Carbon::now()) {
                $orders = PayboxOrder::where('status', 1)
                    ->whereBetween('created_at', [Carbon::create($this->from)->startOfDay(), Carbon::create($this->to)->endOfDay()])
                    ->whereJsonContains('subjects', intval($this->subjectId))
                    ->get();
            } else {
                $orders = PayboxOrder::where('status', 1)
                    ->whereJsonContains('subjects', intval($this->subjectId))
                    ->get();
            }
            $this->countOrders = $orders->count();
            $this->priceOrders = $orders->sum('price');
            $this->grantPrice = round(0.2 * $this->priceOrders);
            $this->cash = round(($this->grantPrice*$this->percentage)/100);
        } else {
            $this->isSearch = false;
        }
    }

    public function getPercentage($subjectID) {
        if ($subjectID == 1 || $subjectID == 3) {
            $percentage = 8.33;
        } elseif ($subjectID == 2) {
            $percentage = 16.66;
        } else {
            $percentage = 33.33;
        }
        return $percentage;
    }

    public function render()
    {
        return view('livewire.admin-dashboard.get-subject-stats');
    }
}
