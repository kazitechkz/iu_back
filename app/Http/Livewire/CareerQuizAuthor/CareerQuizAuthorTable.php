<?php

namespace App\Http\Livewire\CareerQuizAuthor;

use App\Models\CareerQuiz;
use App\Models\CareerQuizGroup;
use App\Models\File;
use App\Models\Subject;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CareerQuizAuthor;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class CareerQuizAuthorTable extends DataTableComponent
{
    protected $model = CareerQuizAuthor::class;

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
                return route('career-quiz-author.edit', $row);
            });
    }

    public function filters(): array
    {
        return [
            SelectFilter::make(__("sidebar.career_quiz_groups"))
                ->options(CareerQuizGroup::pluck("title_ru","id")->toArray())
                ->filter(function($builder, string $value) {
                    return $builder->where(["group_id"=>$value]);
                }),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Удалить'
        ];
    }

    public function deleteSelected(): void
    {
        $items = $this->getSelected();
        foreach ($items as $key => $value) {
            $model = CareerQuizAuthor::find($value);
            if ($model) {
                File::deleteFileFromAWS($model->image_url);
            }
            $model?->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.group_id"), "career_quiz_group.title_ru")
                ->sortable(),
            Column::make(__("table.image_url"), 'file.url')
                ->format(fn($val) => '<img class="w-50" src="'.File::getFileFromAWS($val).'" />')
                ->html(),
            Column::make(__("table.name"), "name")
                ->searchable(),
            Column::make(__("table.position_ru"), "position_ru")
                ->searchable(),
            Column::make(__("table.position_kk"), "position_kk")
                ->searchable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
        ];
    }
}
