<?php

namespace App\Http\Livewire\CareerQuizQuestion;

use App\Models\CareerQuiz;
use App\Models\CareerQuizFeature;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CareerQuizQuestion;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class CareerQuizQuestionTable extends DataTableComponent
{
    protected $model = CareerQuizQuestion::class;

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
                return route('career-quiz-question.edit', $row);
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
                    return $builder->where(["quiz_id"=>$value]);
                }),
            SelectFilter::make(__("sidebar.career_quiz_features"))
                ->options(CareerQuizFeature::pluck("title_ru","id")->toArray())
                ->filter(function($builder, string $value) {
                    return $builder->where(["feature_id"=>$value]);
                }),
        ];
    }

    public function deleteSelected(): void
    {
        $items = $this->getSelected();
        foreach ($items as $key => $value) {
            $model = CareerQuizQuestion::find($value);
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
            Column::make(__("table.question_ru"), "question_ru")
                ->sortable(),
            Column::make(__("table.question_kk"), "question_kk")
                ->sortable(),
            Column::make(__("table.question_en"), "question_en")
                ->sortable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
        ];
    }
}
