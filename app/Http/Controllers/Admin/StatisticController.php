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
        try {
            if (auth()->user()->can("stats-by-user index")) {
                return view('admin.statistics.on-questions');
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    public function statsOnUserContents()
    {
        try {
            if (auth()->user()->can("stats-by-user index")) {
                return view('admin.statistics.user-content-stats');
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }
}
