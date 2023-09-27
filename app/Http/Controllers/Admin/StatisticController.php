<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function statsOnQuestions()
    {
        return view('admin.statistics.on-questions');
    }
}
