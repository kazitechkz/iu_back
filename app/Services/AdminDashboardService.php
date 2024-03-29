<?php

namespace App\Services;

use App\Models\CareerCoupon;
use App\Models\PayboxOrder;
use App\Models\TournamentOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardService
{
    public function getDataByDate(Request $request)
    {
        if (isset($request['from']) && isset($request['to'])) {
            if ($request['from'] !== null && $request['to'] !== null) {
                $from = Carbon::create($request['from'])->startOfDay();
                $to = Carbon::create($request['to'])->endOfDay();
                $data = $this->getDateData($from, $to);
            } else {
                $currentDate = Carbon::now();
                $weekAgo = $currentDate->copy()->subDays(10);
                $data = $this->getDateData($weekAgo, $currentDate);
            }
        } else {
            $currentDate = Carbon::now();
            $weekAgo = $currentDate->copy()->subDays(10);
            $data = $this->getDateData($weekAgo, $currentDate);
        }
        return $data;
    }

    protected function getDateData($from, $to): array
    {
        $data = [
            'users' => [],
            'orders' => [],
            'careers' => [],
            'tournaments' => [],
            'cashes' => [],
            'dates' => [],
        ];
        for ($date = $from->copy(); $date->lte($to); $date->addDay()) {
            $data['dates'][] = $date->format('d.m.Y');
        }
        $newUsersByDate = User::whereBetween('created_at', [$from->toDateString(), $to->toDateString()])
            ->whereNotNull('email_verified_at')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();
        $newCareersByDate = CareerCoupon::whereBetween('created_at', [$from->toDateString(), $to->toDateString()])
            ->where('status', 1)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();
        $newTournamentsByDate = TournamentOrder::whereBetween('created_at', [$from->toDateString(), $to->toDateString()])
            ->where('status', 1)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();
        $newOrdersByDate = PayboxOrder::whereBetween('created_at', [$from->toDateString(), $to->toDateString()])
            ->where('status', 1)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();
        foreach ($data['dates'] as $date) {
            $careerData = $newCareersByDate->firstWhere('date', Carbon::createFromFormat('d.m.Y', $date)->toDateString());
            if ($careerData) {
                $data['careers'][] = $careerData->count;
            } else {
                $data['careers'][] = 0;
            }
        }
        foreach ($data['dates'] as $date) {
            $orderData = $newOrdersByDate->firstWhere('date', Carbon::createFromFormat('d.m.Y', $date)->toDateString());
            if ($orderData) {
                $data['orders'][] = $orderData->count;
            } else {
                $data['orders'][] = 0;
            }
        }
        foreach ($data['dates'] as $date) {
            $tournamentData = $newTournamentsByDate->firstWhere('date', Carbon::createFromFormat('d.m.Y', $date)->toDateString());
            if ($tournamentData) {
                $data['tournaments'][] = $tournamentData->count;
            } else {
                $data['tournaments'][] = 0;
            }
        }
        foreach ($data['dates'] as $date) {
            $userData = $newUsersByDate->firstWhere('date', Carbon::createFromFormat('d.m.Y', $date)->toDateString());
            if ($userData) {
                $data['users'][] = $userData->count;
            } else {
                $data['users'][] = 0;
            }
        }

        return $data;
    }
}
