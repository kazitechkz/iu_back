<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function statsOnQuestions()
    {
        return view('admin.statistics.on-questions');
    }

    public function statsOnUserContents()
    {
        return view('admin.statistics.user-content-stats');
    }
}
