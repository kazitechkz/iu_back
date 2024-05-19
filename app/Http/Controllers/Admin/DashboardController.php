<?php

namespace App\Http\Controllers\Admin;

use App\Charts\MonthlySubjectsChart;
use App\Charts\MonthlyUsersChart;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AdminDashboardService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private AdminDashboardService $adminDashboardService;

    public function __construct(AdminDashboardService $adminDashboardService)
    {
        $this->adminDashboardService = $adminDashboardService;
    }

    public function index(MonthlyUsersChart $chart, Request $request)
    {
        $data = $this->adminDashboardService->getDataByDate($request);
        $subjectData = $this->adminDashboardService->getSubjectsTableByDate($request);
        return view('admin.dashboard', ['chart' => $chart->build($data), 'subjectData' => $subjectData]);
    }

    public function filterByDate(MonthlyUsersChart $chart, Request $request)
    {
        $data = $this->adminDashboardService->getDataByDate($request);
        $subjectData = $this->adminDashboardService->getSubjectsTableByDate($request);
        return view('admin.dashboard', ['chart' => $chart->build($data), 'subjectData' => $subjectData]);
    }
}
