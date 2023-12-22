<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Question;
use App\Models\QuestionTranslation;
use App\Models\QuestionType;
use App\Models\Subject;
use App\Services\TranslateService;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (auth()->user()->can("translation index")) {
                $data = QuestionTranslation::searchableData(null, true);
                return view("admin.translation.index", compact('data'));
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    public function search(Request $request)
    {
        try {
            if (auth()->user()->can("translation index")) {
                $this->validate($request, [
                   'subject_id' => 'required',
                   'type_id' => 'required'
                ]);
                $data = QuestionTranslation::searchableData($request, false);
                if ($request['question'] && $request['type_id'] == 1 || $request['question'] && $request['type_id'] == 3) {
                    TranslateService::saveOneAnswerQuestion($request['question']);
                    return redirect(route('search-translations', $data['params']));
                }
                if ($request['question'] && $request['type_id'] == 2) {
                    TranslateService::saveContextQuestion($request['question']);
                    return redirect(route('search-translations', $data['params']));
                }
                return view("admin.translation.index", compact('data'));
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }

    public function forceDelete(Request $request)
    {
        try {
            $this->validate($request, [
                'subject_id' => 'required',
                'type_id' => 'required',
                'delete_id' => 'required'
            ]);
            if ($request['delete_id']) {
                $tr = QuestionTranslation::with('questionRU.context.translationContextRU')->where('question_ru', $request['delete_id'])->first();
                $tr->questionRU?->context?->translationContextRU?->delete();
                $tr->questionRU?->context?->delete();
                $tr->questionRU?->delete();
                $tr->delete();
            }
            $data = QuestionTranslation::searchableData($request, false);
            return view("admin.translation.index", compact('data'));
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }
}
