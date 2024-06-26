<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MethodistContentStat;
use App\Models\MethodistQuestion;
use App\Models\Subject;
use App\Models\User;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function statsOnTests()
    {
        try {
            if (auth()->user()->can("stats-by-user index")) {
                return view('admin.statistics.on-tests');
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }
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
    public function statsOnSubjects()
    {
        try {
            if (auth()->user()->can("stats-by-user index")) {
                return view('admin.statistics.on-subjects');
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }
    public function statsOnTypes()
    {
        try {
            if (auth()->user()->can("stats-by-user index")) {
                return view('admin.statistics.on-types');
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }
    public function statsOnOrders()
    {
        try {
            if (auth()->user()->can("stats-by-user index")) {
                return view('admin.paybox.index');
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }
    public function statsOnOrdersBySubjects()
    {
        try {
            if (auth()->user()->can("stats-by-user index")) {
                return view('admin.statistics.on-orders');
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
                $userID = $id;
                $subjects = Subject::all();
                $contents = MethodistContentStat::where('created_user', $id)
                    ->whereHas('sub_step_content.step')
                    ->with('sub_step_content.step.subject')
                    ->paginate(10);
                return view(    'admin.statistics.user-content-stats', compact('contents', 'userID', 'subjects'));
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
                $userID = $id;
                $subjects = Subject::all();
                $questions = MethodistQuestion::where('user_id', $id)
                    ->whereHas('question', function ($query) {
                        $query->where('locale_id', 1);
                    })
                    ->with('question.subject')
                    ->latest()
                    ->paginate(10);
                return view('admin.statistics.user-tests-stats', compact('questions', 'subjects', 'userID'));
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
                $userID = $id;
                $subjects = Subject::all();
                $translates = MethodistQuestion::where('user_id', $id)
                    ->whereHas('question.translationQuestionRU.questionKK')
                    ->whereHas('question', function ($query) {
                        $query->where('locale_id', 2);
                    })
                    ->with('question.translationQuestionRU.questionKK')
                    ->latest()
                    ->paginate(10);
                return view('admin.statistics.user-translates-stats', compact('translates', 'subjects', 'userID'));
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    public function filterStatsOnUser(Request $request)
    {
        try {
            if (auth()->user()->can("stats-by-user index")) {
                if ($request['is_test']) {
                    $userID = $request['user_id'];
                    if ($request['subject_id'] && $request['date']) {
                        $subjectID = $request['subject_id'];
                        $questions = MethodistQuestion::where('user_id', $request['user_id'])
                            ->whereBetween('created_at', [Carbon::create($request['date'])->startOfDay(), Carbon::create($request['date'])->endOfDay()])
                            ->whereHas('question', function ($query) {
                                $query->where('locale_id', 1);
                            })
                            ->whereHas('question.subject', function ($query) use ($subjectID) {
                                $query->where('id', $subjectID);
                        })
                            ->with('question.subject')
                            ->latest()
                            ->paginate(10);
                    } elseif ($request['subject_id'] && !$request['date']) {
                        $subjectID = $request['subject_id'];
                        $questions = MethodistQuestion::where('user_id', $request['user_id'])
                            ->whereHas('question', function ($query) {
                                $query->where('locale_id', 1);
                            })
                            ->whereHas('question.subject', function ($query) use ($subjectID) {
                                $query->where('id', $subjectID);
                            })
                            ->with('question.subject')
                            ->latest()
                            ->paginate(10);
                    } elseif (!$request['subject_id'] && $request['date']) {
                        $questions = MethodistQuestion::where('user_id', $request['user_id'])
                            ->whereBetween('created_at', [Carbon::create($request['date'])->startOfDay(), Carbon::create($request['date'])->endOfDay()])
                            ->whereHas('question', function ($query) {
                                $query->where('locale_id', 1);
                            })
                            ->with('question.subject')
                            ->latest()
                            ->paginate(10);
                    } else {
                        $questions = MethodistQuestion::where('user_id', $request['user_id'])
                            ->whereHas('question', function ($query) {
                                $query->where('locale_id', 1);
                            })
                            ->with('question.subject')
                            ->latest()
                            ->paginate(10);
                    }
                    $subjects = Subject::all();
                    return view('admin.statistics.user-tests-stats', compact('questions', 'subjects', 'userID'));
                }
                elseif ($request['is_translate']) {
                    $userID = $request['user_id'];
                    $subjects = Subject::all();
                    if ($request['subject_id'] && $request['date']) {
                        $subjectID = $request['subject_id'];
                        $translates = MethodistQuestion::where('user_id', $userID)
                            ->whereHas('question.subject', function ($query) use ($subjectID) {
                                $query->where('id', $subjectID);
                            })
                            ->whereBetween('created_at', [Carbon::create($request['date'])->startOfDay(), Carbon::create($request['date'])->endOfDay()])
                            ->whereHas('question.translationQuestionRU.questionKK')
                            ->whereHas('question', function ($query) {
                                $query->where('locale_id', 2);
                            })
                            ->with('question.translationQuestionRU.questionKK')
                            ->latest()
                            ->paginate(10);
                    } elseif ($request['subject_id'] && !$request['date']) {
                        $subjectID = $request['subject_id'];
                        $translates = MethodistQuestion::where('user_id', $userID)
                            ->whereHas('question.subject', function ($query) use ($subjectID) {
                                $query->where('id', $subjectID);
                            })
                            ->whereHas('question.translationQuestionRU.questionKK')
                            ->whereHas('question', function ($query) {
                                $query->where('locale_id', 2);
                            })
                            ->with('question.translationQuestionRU.questionKK')
                            ->latest()
                            ->paginate(10);
                    } elseif ($request['date'] && !$request['subject_id']) {
                        $translates = MethodistQuestion::where('user_id', $userID)
                            ->whereBetween('created_at', [Carbon::create($request['date'])->startOfDay(), Carbon::create($request['date'])->endOfDay()])
                            ->whereHas('question.translationQuestionRU.questionKK')
                            ->whereHas('question', function ($query) {
                                $query->where('locale_id', 2);
                            })
                            ->with('question.translationQuestionRU.questionKK')
                            ->latest()
                            ->paginate(10);
                    } else {
                        $translates = MethodistQuestion::where('user_id', $userID)
                            ->whereHas('question.translationQuestionRU.questionKK')
                            ->whereHas('question', function ($query) {
                                $query->where('locale_id', 2);
                            })
                            ->with('question.translationQuestionRU.questionKK')
                            ->latest()
                            ->paginate(10);
                    }
                    return view('admin.statistics.user-translates-stats', compact('translates', 'subjects', 'userID'));
                }
                elseif ($request['is_contents']) {
                    $userID = $request['user_id'];
                    $subjects = Subject::all();
                    if ($request['subject_id'] && $request['date']) {
                        $subjectID = $request['subject_id'];
                        $contents = MethodistContentStat::where('created_user', $userID)
                            ->whereBetween('created_at', [Carbon::create($request['date'])->startOfDay(), Carbon::create($request['date'])->endOfDay()])
                            ->whereHas('sub_step_content.step.subject', function ($query) use ($subjectID) {
                                $query->where('id', $subjectID);
                            })
                            ->with('sub_step_content.step.subject')
                            ->paginate(10);
                    }
                    elseif ($request['subject_id'] && !$request['date']) {
                        $subjectID = $request['subject_id'];
                        $contents = MethodistContentStat::where('created_user', $userID)
                            ->whereHas('sub_step_content.step.subject', function ($query) use ($subjectID) {
                                $query->where('id', $subjectID);
                            })
                            ->with('sub_step_content.step.subject')
                            ->paginate(10);
                    }
                    elseif ($request['date'] && !$request['subject_id']) {
                        $contents = MethodistContentStat::where('created_user', $userID)
                            ->whereBetween('created_at', [Carbon::create($request['date'])->startOfDay(), Carbon::create($request['date'])->endOfDay()])
                            ->whereHas('sub_step_content.step.subject')
                            ->with('sub_step_content.step.subject')
                            ->paginate(10);
                    }
                    else {
                        $contents = MethodistContentStat::where('created_user', $userID)
                            ->whereHas('sub_step_content.step.subject')
                            ->with('sub_step_content.step.subject')
                            ->paginate(10);
                    }
                    return view(    'admin.statistics.user-content-stats', compact('contents', 'userID', 'subjects'));
                }
                else {
                    return redirect(route('stats-on-user'));
                }
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }
}
