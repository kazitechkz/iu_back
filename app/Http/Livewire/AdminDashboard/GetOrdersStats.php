<?php

namespace App\Http\Livewire\AdminDashboard;

use App\Models\CareerCoupon;
use App\Models\PayboxOrder;
use App\Models\TournamentOrder;
use Carbon\Carbon;
use Livewire\Component;

class GetOrdersStats extends Component
{
    public $countOrders;
    public $priceOrders;
    public $orders = [];
    public $countCareers;
    public $priceCareers;
    public $careers = [];
    public $countTournaments;
    public $priceTournaments;
    public $tournaments = [];
    public $total;

    public function mount(): void
    {
        $this->orders = PayboxOrder::where('status', 1)->get();
        $this->careers = CareerCoupon::where(['status' => 1, ['order_id', '!=', 0]])->get();
        $this->countOrders = $this->orders->count();
        $this->countCareers = $this->careers->count();
        $this->priceOrders = $this->orders->sum('price');
        $this->priceCareers = CareerCoupon::has('career_quiz')->where(['status' => 1, ['order_id', '!=', 0]])->withSum('career_quiz', 'price')->get()->sum('career_quiz_sum_price');
        $this->tournaments = TournamentOrder::where('status', 1)->get();
        $this->countTournaments = $this->tournaments->count();
        $this->priceTournaments = $this->tournaments->sum('price');
        $this->total = $this->priceTournaments + $this->priceCareers + $this->priceOrders;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin-dashboard.get-orders-stats');
    }
}
