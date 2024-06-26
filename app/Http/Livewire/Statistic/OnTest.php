<?php

namespace App\Http\Livewire\Statistic;

use App\Models\Question;
use App\Models\Subject;
use Livewire\Component;

class OnTest extends Component
{
    public $subjects;
    public function mount(): void
    {
        $this->subjects = Subject::withCount(['questions_kk', 'questions_ru', 'questions_kk_sorted', 'questions_ru_sorted'])->get();
    }

    public function getStatBySubjectId($subjectID): array
    {
        $data = [];
        $sortedQuestionsKk = Question::where(['subject_id' => $subjectID, 'locale_id' => 1])
            ->whereNull('deleted_at')
            ->whereNotNull('sub_category_id')
            ->count();
        $sortedQuestionsRu = Question::where(['subject_id' => $subjectID, 'locale_id' => 2])
            ->whereNull('deleted_at')
            ->whereNotNull('sub_category_id')
            ->count();
        $unSortedQuestionsKk = Question::where(['subject_id' => $subjectID, 'locale_id' => 1])
            ->whereNull('deleted_at')
            ->whereNull('sub_category_id')
            ->count();
        $unSortedQuestionsRu = Question::where(['subject_id' => $subjectID, 'locale_id' => 2])
            ->whereNull('deleted_at')
            ->whereNull('sub_category_id')
            ->count();
        $data['allTestsKk'] = $sortedQuestionsKk + $unSortedQuestionsKk;
        $data['allTestsRu'] = $sortedQuestionsRu + $unSortedQuestionsRu;
        $data['sortedKk'] = $sortedQuestionsKk;
        $data['sortedRu'] = $sortedQuestionsRu;
        $data['unSortedKk'] = $unSortedQuestionsKk;
        $data['unSortedRu'] = $unSortedQuestionsRu;
        return $data;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.statistic.on-test');
    }
}
