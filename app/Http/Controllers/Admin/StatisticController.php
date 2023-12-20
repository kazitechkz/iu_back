<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MethodistContentStat;
use App\Models\MethodistQuestion;
use App\Models\User;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
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
    public function statsOnUser()
    {
        try {
            if (auth()->user()->can("stats-by-user index")) {
                return view('admin.statistics.user-stats');
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    public function statsOnUserContents($id)
    {
        try {
            if (auth()->user()->can("stats-by-user index")) {
                $contents = MethodistContentStat::where('created_user', $id)
                    ->whereHas('sub_step_content.step')
                    ->with('sub_step_content.step.subject')
                    ->paginate(10);
                return view(    'admin.statistics.user-content-stats', compact('contents'));
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    public function statsOnUserTests($id)
    {
        try {
            if (auth()->user()->can("stats-by-user index")) {
                $questions = MethodistQuestion::where('user_id', $id)
                    ->whereHas('question', function ($query) {
                        $query->where('locale_id', 1);
                    })
                    ->with('question.subject')
                    ->latest()
                    ->paginate(10);
                return view('admin.statistics.user-tests-stats', compact('questions'));
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    public function statsOnUserTranslates($id)
    {
        try {
            if (auth()->user()->can("stats-by-user index")) {
                $translates = MethodistQuestion::where('user_id', $id)
                    ->whereHas('question.translationQuestionRU.questionKK')
                    ->whereHas('question', function ($query) {
                        $query->where('locale_id', 2);
                    })
                    ->with('question.translationQuestionRU.questionKK')
                    ->latest()
                    ->paginate(10);
                return view('admin.statistics.user-translates-stats', compact('translates'));
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }
}
