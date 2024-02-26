<?php

namespace App\Http\Livewire\Statistic;

use App\Models\Question;
use App\Models\Subject;
use Livewire\Component;

class OnType extends Component
{
    public $subjects;
    public $questions;

    public function mount(): void
    {
        $this->subjects = Subject::withCount([
            'questions',
            'questions_kk',
            'questions_ru',
            'questions_single_type_kk',
            'questions_single_type_ru',
            'questions_context_type_kk',
            'questions_context_type_ru',
            'questions_multi_type_kk',
            'questions_multi_type_ru',
        ])->get();
        $this->questions = $this->calc();
    }

    public function calc(): array
    {
        $questions = [
            'single_all_kk' => 0,
            'single_all_ru' => 0,
            'context_all_kk' => 0,
            'context_all_ru' => 0,
            'multi_all_kk' => 0,
            'multi_all_ru' => 0
        ];
        foreach ($this->subjects as $subject) {
            $questions['single_all_kk'] += $subject->questions_single_type_kk_count;
            $questions['single_all_ru'] += $subject->questions_single_type_ru_count;
            $questions['context_all_kk'] += $subject->questions_context_type_kk_count;
            $questions['context_all_ru'] += $subject->questions_context_type_ru_count;
            $questions['multi_all_kk'] += $subject->questions_multi_type_kk_count;
            $questions['multi_all_ru'] += $subject->questions_multi_type_ru_count;
        }
        return $questions;
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.statistic.on-type');
    }
}
