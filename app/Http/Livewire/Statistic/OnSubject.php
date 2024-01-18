<?php

namespace App\Http\Livewire\Statistic;

use App\Models\Question;
use App\Models\Subject;
use Livewire\Component;

class OnSubject extends Component
{
    public $subjects;
    public $questions;

    public function mount()
    {
        $this->subjects = Subject::withCount([
            'questions',
            'questions_kk',
            'questions_ru',
            'questions_bobo_kk',
            'questions_bobo_ru',
            'questions_grant_kk',
            'questions_grant_ru',
            'questions_shin_kk',
            'questions_shin_ru',
            'questions_orbital_kk',
            'questions_orbital_ru',
            'questions_istudy_kk',
            'questions_istudy_ru',
            'questions_other_kk',
            'questions_other_ru',
        ])->get();
        $this->questions = $this->calc();
    }

    public function calc()
    {
        $questions = [
            'all' => 0,
            'all_kk' => 0,
            'all_ru' => 0,
            'grant_all' => 0,
            'grant_kk' => 0,
            'grant_ru' => 0,
            'grant_per' => 0,
            'bobo_all' => 0,
            'bobo_kk' => 0,
            'bobo_ru' => 0,
            'bobo_per' => 0,
            'orbital_all' => 0,
            'orbital_kk' => 0,
            'orbital_ru' => 0,
            'orbital_per' => 0,
            'istudy_all' => 0,
            'istudy_kk' => 0,
            'istudy_ru' => 0,
            'istudy_per' => 0,
            'shin_all' => 0,
            'shin_kk' => 0,
            'shin_ru' => 0,
            'shin_per' => 0,
            'other_all' => 0,
            'other_kk' => 0,
            'other_ru' => 0,
            'other_per' => 0
        ];
        foreach ($this->subjects as $subject) {
            $questions['all'] += $subject->questions_count;
            $questions['all_kk'] += $subject->questions_kk_count;
            $questions['all_ru'] += $subject->questions_ru_count;
            $questions['grant_all'] += $subject->questions_grant_kk_count + $subject->questions_grant_ru_count;
            $questions['grant_kk'] += $subject->questions_grant_kk_count;
            $questions['grant_ru'] += $subject->questions_grant_ru_count;
            $questions['bobo_all'] += $subject->questions_bobo_kk_count + $subject->questions_bobo_ru_count;
            $questions['bobo_kk'] += $subject->questions_bobo_kk_count;
            $questions['bobo_ru'] += $subject->questions_bobo_ru_count;
            $questions['shin_all'] += $subject->questions_shin_kk_count + $subject->questions_shin_ru_count;
            $questions['shin_kk'] += $subject->questions_shin_kk_count;
            $questions['shin_ru'] += $subject->questions_shin_ru_count;
            $questions['orbital_all'] += $subject->questions_orbital_kk_count + $subject->questions_orbital_ru_count;
            $questions['orbital_kk'] += $subject->questions_orbital_kk_count;
            $questions['orbital_ru'] += $subject->questions_orbital_ru_count;
            $questions['istudy_all'] += $subject->questions_istudy_kk_count + $subject->questions_istudy_ru_count;
            $questions['istudy_kk'] += $subject->questions_istudy_kk_count;
            $questions['istudy_ru'] += $subject->questions_istudy_ru_count;
            $questions['other_all'] += $subject->questions_other_kk_count + $subject->questions_other_ru_count;
            $questions['other_kk'] += $subject->questions_other_kk_count;
            $questions['other_ru'] += $subject->questions_other_ru_count;
        }
        $questions['grant_per'] += round((($questions['grant_all'])/$questions['all'])*100,1);
        $questions['bobo_per'] += round((($questions['bobo_all'])/$questions['all'])*100,1);
        $questions['orbital_per'] += round((($questions['orbital_all'])/$questions['all'])*100,1);
        $questions['shin_per'] += round((($questions['shin_all'])/$questions['all'])*100,1);
        $questions['istudy_per'] += round((($questions['istudy_all'])/$questions['all'])*100,1);
        $questions['other_per'] += round((($questions['other_all'])/$questions['all'])*100,1);
        return $questions;
    }
    public function render()
    {
        return view('livewire.statistic.on-subject');
    }
}
