<?php

namespace App\Http\Livewire\CareerQuizAnswer;

use App\Models\CareerQuiz;
use App\Models\CareerQuizFeature;
use App\Models\File;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CareerQuizAnswer;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class CareerQuizAnswerTable extends DataTableComponent
{
    protected $model = CareerQuizAnswer::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,40,80,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('career-quiz-answer.edit', $row);
            });
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Удалить'
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make(__("sidebar.career_quizzes"))
                ->options(CareerQuiz::pluck("title_ru","id")->toArray())
                ->filter(function($builder, string $value) {
                    return $builder->where(["career_quiz_answers.quiz_id"=>$value]);
                }),
        ];
    }

    public function deleteSelected(): void
    {
        $items = $this->getSelected();
        foreach ($items as $key => $value) {
            $model = CareerQuizAnswer::find($value);
            $model?->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.quiz_id"), "career_quiz.title_ru")
                ->sortable(),
            Column::make(__("table.feature_id"), "career_quiz_feature.title_ru")
                ->sortable(),
            Column::make(__("table.question_id"), "career_quiz_question.question_ru")
                ->sortable(),
            Column::make(__("table.title_ru"), "title_ru")
                ->searchable(),
            Column::make(__("table.title_kk"), "title_kk")
                ->searchable(),
            Column::make(__("table.title_en"), "title_en")
                ->searchable(),
            Column::make(__("table.value"), "value")
                ->searchable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
        ];
    }
}
