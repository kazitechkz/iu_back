<?php

namespace App\Http\Livewire\CareerQuizGroup;

use App\Models\AppealType;
use App\Models\CareerQuiz;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CareerQuizGroup;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class CareerQuizGroupTable extends DataTableComponent
{
    protected $model = CareerQuizGroup::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,40,80,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('career-quiz-group.edit', $row);
            });
    }

    public function filters(): array
    {
        return [
            SelectFilter::make(__("sidebar.career_quizzes"))
                ->options(CareerQuiz::pluck("title_ru","id")->toArray())
                ->filter(function($builder, string $value) {
                    return $builder->where(["quiz_id"=>$value]);
                }),
        ];
    }

    public function deleteSelected()
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = CareerQuizGroup::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.title_ru"), "title_ru")
                ->searchable(),
            Column::make(__("table.title_kk"), "title_kk")
                ->searchable(),
            Column::make(__("table.title_en"), "title_en")
                ->searchable(),
            Column::make(__("table.email"), "email")
                ->searchable(),
            Column::make(__("table.phone"), "phone")
                ->searchable(),
            Column::make(__("table.address"), "address")
                ->searchable(),
            Column::make(__("table.price"), "price")
                ->searchable(),
            Column::make(__("table.currency"), "currency")
                ->searchable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
        ];
    }
}
