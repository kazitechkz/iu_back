<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Locale;
use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\SurveyQuestion;
use App\Services\SurveyService;
use Illuminate\Http\Request;

class SurveyQuestionController extends Controller
{
    private SurveyService $surveyService;

    /**
     * @param SurveyService $surveyService
     */
    public function __construct(SurveyService $surveyService)
    {
        $this->surveyService = $surveyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if (auth()->user()->can("survey edit")) {
                $this->validate($request, [
                   'text' => 'required',
                   'locale_id' => 'required'
                ]);
                SurveyQuestion::add($request->all());
                return redirect()->back();
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            if (auth()->user()->can("survey show")) {
                $locales = Locale::all();
                $survey = Survey::findOrFail($id);
                $questions = SurveyQuestion::where('survey_id', $id)->get();
                return view("admin.survey-question.show", compact('locales', 'survey', 'questions'));
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $surveyID)
    {
//        try {
//            if (auth()->user()->can("survey edit")) {
//                $data = $this->surveyService->getSurveyStats($surveyID);
//                return view('admin.survey-question.edit', compact('data'));
//            } else {
//                toastr()->warning(__("message.not_allowed"));
//                return redirect()->route("home");
//            }
//        } catch (\Exception $exception) {
//            toastr()->error($exception->getMessage(), "Error");
//            return redirect()->route("home");
//        }
    }
    public function filterByLocale(string $surveyID, $localeID)
    {
        try {
            if (auth()->user()->can("survey edit")) {
                $data = $this->surveyService->getSurveyStats($surveyID, $localeID);
//                dd($data);
                return view('admin.survey-question.edit', compact('data', 'surveyID'));
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if (auth()->user()->can("survey edit")) {
                $q = SurveyQuestion::findOrFail($id);
                $q->delete();
                return redirect()->back();
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }
}
