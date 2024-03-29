<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($data): \ArielMejiaDev\LarapexCharts\LineChart
    {
        return $this->chart->lineChart()
            ->setTitle('Анализ новых пользователей')
//            ->setSubtitle('Physical sales vs Digital sales.')
            ->addData('Новые пользователи', $data['users'])
            ->addData('Транзакции по подпискам', $data['orders'])
            ->addData('Транзакции по профориентациям', $data['careers'])
            ->addData('Транзакции по турнирам', $data['tournaments'])
//            ->addData('Digital sales', [700, 29, 77, 28, 55, 45])
            ->setXAxis($data['dates']);
    }

    public function getEndDay($date)
    {
        return Carbon::create($date)->endOfDay();
    }
}
