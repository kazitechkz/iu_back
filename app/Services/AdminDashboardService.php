<?php

namespace App\Services;

use App\Models\CareerCoupon;
use App\Models\PayboxOrder;
use App\Models\Subject;
use App\Models\TournamentOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardService
{
    public function getDataByDate(Request $request): array
    {
        if (isset($request['from']) && isset($request['to'])) {
            if ($request['from'] !== null && $request['to'] !== null) {
                $from = Carbon::create($request['from'])->startOfDay();
                $to = Carbon::create($request['to'])->endOfDay();
                $data = $this->getDateData($from, $to);
            } else {
                $currentDate = Carbon::now()->endOfDay();
                $weekAgo = $currentDate->copy()->subDays(10);
                $data = $this->getDateData($weekAgo, $currentDate);
            }
        } else {
            $currentDate = Carbon::now()->endOfDay();
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
        $newUsersByDate = User::whereBetween('created_at', [Carbon::create($from->toDateString())->startOfDay(), Carbon::create($to->toDateString())->endOfDay()])
            ->whereNotNull('email_verified_at')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();
        $newCareersByDate = CareerCoupon::whereBetween('created_at', [Carbon::create($from->toDateString())->startOfDay(), Carbon::create($to->toDateString())->endOfDay()])
            ->where('status', 1)
            ->where('order_id', '!=', 0)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();
        $newTournamentsByDate = TournamentOrder::whereBetween('created_at', [Carbon::create($from->toDateString())->startOfDay(), Carbon::create($to->toDateString())->endOfDay()])
            ->where('status', 1)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();
        $newOrdersByDate = PayboxOrder::whereBetween('created_at', [Carbon::create($from->toDateString())->startOfDay(), Carbon::create($to->toDateString())->endOfDay()])
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

    public function getSubjectsTableByDate(Request $request)
    {
        if (isset($request['from']) && isset($request['to'])) {
            if ($request['from'] !== null && $request['to'] !== null) {
                $from = Carbon::create($request['from'])->startOfDay();
                $to = Carbon::create($request['to'])->endOfDay();
                $data = $this->getSubjectsData($from, $to);
            } else {
                $data = $this->getSubjectsData();
            }
        } else {
            $data = $this->getSubjectsData();
        }
        return $data;
    }
    protected function getSubjectsData($from = null, $to = null)
    {
        $data = [];
        if ($from && $to) {
            foreach (Subject::all() as $item) {
                $count = PayboxOrder::whereBetween('created_at', [Carbon::create($from->toDateString())->startOfDay(), Carbon::create($to->toDateString())->endOfDay()])
                    ->where('status', 1)
                    ->whereJsonContains('subjects', $item->id)
                    ->count();
                $data[$item->title_ru] = $count;
            }
            return $data;
        } else {
            foreach (Subject::all() as $item) {
                $count = PayboxOrder::where('status', 1)
                    ->whereJsonContains('subjects', $item->id)
                    ->count();
                $data[$item->title_ru] = $count;
            }
        }
        return $data;
    }
    public function getOrdersByDate(Request $request): array
    {
        if (isset($request['from']) && isset($request['to'])) {
            if ($request['from'] !== null && $request['to'] !== null) {
                $from = Carbon::create($request['from'])->startOfDay();
                $to = Carbon::create($request['to'])->endOfDay();
                $data = $this->getOrderData($from, $to);
            } else {
                $currentDate = Carbon::now()->endOfDay();
                $weekAgo = $currentDate->copy()->subDays(10);
                $data = $this->getOrderData($weekAgo, $currentDate);
            }
        } else {
            $currentDate = Carbon::now()->endOfDay();
            $weekAgo = $currentDate->copy()->subDays(10);
            $data = $this->getOrderData($weekAgo, $currentDate);
        }
        return $data;
    }
    protected function getOrderData($from, $to): array
    {
        $data = [
            'dates' => [],
            'subject_1' => [],
            'subject_2' => [],
            'subject_3' => [],
            'subject_4' => [],
            'subject_5' => [],
            'subject_6' => [],
            'subject_7' => [],
            'subject_8' => [],
            'subject_9' => [],
            'subject_10' => [],
            'subject_11' => [],
            'subject_12' => [],
            'subject_13' => [],
            'subject_14' => [],
            'subject_15' => [],
            'subject_16' => []
        ];
        for ($date = $from->copy(); $date->lte($to); $date->addDay()) {
            $data['dates'][] = $date->format('d.m.Y');
        }
        foreach (Subject::all() as $item) {
            $data = $this->getSubjectData($data, $item->id, $from, $to);
        }
        return $data;
    }
    protected function getSubjectData($data, $id, $from, $to): array
    {
        $newSubject = PayboxOrder::whereBetween('created_at', [Carbon::create($from->toDateString())->startOfDay(), Carbon::create($to->toDateString())->endOfDay()])
            ->where('status', 1)
            ->whereJsonContains('subjects', $id)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();
        foreach ($data['dates'] as $date) {
            $subjectData = $newSubject->firstWhere('date', Carbon::createFromFormat('d.m.Y', $date)->toDateString());
            if ($subjectData) {
                $data['subject_'.$id][] = $subjectData->count;
            } else {
                $data['subject_'.$id][] = 0;
            }
        }
        return $data;
    }
}
