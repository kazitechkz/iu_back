<?php

namespace App\Http\Livewire\Statistic;

use App\Models\MethodistContentStat;
use App\Models\MethodistQuestion;
use App\Models\User;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Carbon\Carbon;
use Livewire\Component;

class OnUserContent extends Component
{
    public $data;
    public $date;
    public $time;
    public function mount(): void
    {
        $userIDS = User::role(['method', 'assist'])->pluck('id', 'name');
        $this->getAllStats($userIDS);
    }

    public function updatedDate(): void
    {
        $date = $this->date;
        $userIDS = User::role(['method', 'assist'])->pluck('id', 'name');
        foreach ($userIDS as $key => $value) {
            $this->data[$key]['id'] = $value;
            $this->data[$key]['questions_kk'] = MethodistQuestion::where('user_id', $value)->whereHas('question', function ($q) use ($date) {
                $q->where('locale_id', 1)->whereBetween('created_at', [Carbon::create($date)->startOfDay(), Carbon::create($date)->endOfDay()]);;
            })->count();
            $this->data[$key]['questions_ru'] = MethodistQuestion::where('user_id', $value)
                ->whereHas('question.translationQuestionRU')
                ->whereHas('question', function ($q) use ($date) {
                $q->where('locale_id', 2)->whereBetween('created_at', [Carbon::create($date)->startOfDay(), Carbon::create($date)->endOfDay()]);;
            })->count();
            $this->data[$key]['contents'] = MethodistContentStat::where('created_user', $value)
                ->whereBetween('created_at', [Carbon::create($date)->startOfDay(), Carbon::create($date)->endOfDay()])
                ->whereHas('sub_step_content')
                ->count();
        }

    }

    public function updatedTime(): void
    {
        $time = $this->time;
        $userIDS = User::role(['method', 'assist'])->pluck('id', 'name');
        if ($time == 1) {
            $this->getAllStats($userIDS);
        } elseif ($time == 2) {
            foreach ($userIDS as $key => $value) {
                $this->data[$key]['id'] = $value;
                $this->data[$key]['questions_kk'] = MethodistQuestion::where('user_id', $value)
                    ->whereHas('question', function ($q) {
                    $q->where('locale_id', 1)
                        ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()]);
                })->count();
                $this->data[$key]['questions_ru'] = MethodistQuestion::where('user_id', $value)
                    ->whereHas('question.translationQuestionRU')
                    ->whereHas('question', function ($q) {
                    $q->where('locale_id', 2)
                        ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()]);
                })->count();
                $this->data[$key]['contents'] = MethodistContentStat::where('created_user', $value)
                    ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
                    ->whereHas('sub_step_content')->count();
            }
        } elseif ($time == 3) {
            foreach ($userIDS as $key => $value) {
                $this->data[$key]['id'] = $value;
                $this->data[$key]['questions_kk'] = MethodistQuestion::where('user_id', $value)
                    ->whereHas('question', function ($q) {
                        $q->where('locale_id', 1)
                            ->whereBetween('created_at', [Carbon::today()->subWeek()->startOfDay(), Carbon::today()->endOfDay()]);
                    })->count();
                $this->data[$key]['questions_ru'] = MethodistQuestion::where('user_id', $value)
                    ->whereHas('question.translationQuestionRU')
                    ->whereHas('question', function ($q) {
                        $q->where('locale_id', 2)
                            ->whereBetween('created_at', [Carbon::today()->subWeek()->startOfDay(), Carbon::today()->endOfDay()]);
                    })->count();
                $this->data[$key]['contents'] = MethodistContentStat::where('created_user', $value)
                    ->whereBetween('created_at', [Carbon::today()->subWeek()->startOfDay(), Carbon::today()->endOfDay()])
                    ->whereHas('sub_step_content')->count();
            }
        } elseif ($time == 4) {
            foreach ($userIDS as $key => $value) {
                $this->data[$key]['id'] = $value;
                $this->data[$key]['questions_kk'] = MethodistQuestion::where('user_id', $value)
                    ->whereHas('question', function ($q) {
                        $q->where('locale_id', 1)
                            ->whereBetween('created_at', [Carbon::today()->subMonth()->startOfDay(), Carbon::today()->endOfDay()]);
                    })->count();
                $this->data[$key]['questions_ru'] = MethodistQuestion::where('user_id', $value)
                    ->whereHas('question.translationQuestionRU')
                    ->whereHas('question', function ($q) {
                        $q->where('locale_id', 2)
                            ->whereBetween('created_at', [Carbon::today()->subMonth()->startOfDay(), Carbon::today()->endOfDay()]);
                    })->count();
                $this->data[$key]['contents'] = MethodistContentStat::where('created_user', $value)
                    ->whereBetween('created_at', [Carbon::today()->subMonth()->startOfDay(), Carbon::today()->endOfDay()])
                    ->whereHas('sub_step_content')->count();
            }
        }
    }
    public function render()
    {
        $questionsChart = (new ColumnChartModel())->setTitle('Статистика по Тестам');
        $contentsChart = (new ColumnChartModel())->setTitle('Статистика по Конспекстам');
        $translationsChart = (new ColumnChartModel())->setTitle('Статистика по переводам');
        foreach ($this->data as $key => $value) {
            $questionsChart->addColumn($key, $value['questions_kk'], $this->getRandomColor());
            $contentsChart->addColumn($key, $value['contents'], $this->getRandomColor());
            $translationsChart->addColumn($key, $value['questions_ru'], $this->getRandomColor());
        }
        return view('livewire.statistic.on-user-stats', [
            'questionsChart' => $questionsChart,
            'contentsChart' => $contentsChart,
            'translationChart' => $translationsChart
        ]);
    }

    /**
     * @param \Illuminate\Support\Collection $userIDS
     * @return void
     */
    public function getAllStats(\Illuminate\Support\Collection $userIDS): void
    {
        foreach ($userIDS as $key => $value) {
            $this->data[$key]['id'] = $value;
            $this->data[$key]['questions_kk'] = MethodistQuestion::where('user_id', $value)
                ->whereHas('question', function ($q) {
                $q->where('locale_id', 1);
            })->count();
            $this->data[$key]['questions_ru'] = MethodistQuestion::where('user_id', $value)
                ->whereHas('question.translationQuestionRU')
                ->whereHas('question', function ($q) {
                $q->where('locale_id', 2);
            })->count();
            $this->data[$key]['contents'] = MethodistContentStat::where('created_user', $value)
            ->whereHas('sub_step_content')->count();
        }
    }

    public function getRandomColor(): string
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}
