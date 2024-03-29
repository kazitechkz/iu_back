<?php

namespace App\Http\Livewire\AdminDashboard;

use App\Charts\MonthlyUsersChart;
use Livewire\Component;

class GetNewUsers extends Component
{
    public string $chart;
    public function mount(MonthlyUsersChart $chart)
    {
        $this->chart = $chart;
    }
    public function render()
    {

        return view('livewire.admin-dashboard.get-new-users', ['chart' => $this->chart->build('asdad')]);
    }
}
