<?php

namespace App\Http\Livewire\Survey;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Survey;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class IndexTable extends DataTableComponent
{
    protected $model = Survey::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setBulkActions([
            'deleteSelected' => 'Удалить',
            'deActiveStatus' => 'Деактивировать статус',
            'activeStatus' => 'Активировать статус'
        ]);
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Удалить',
            'deActiveStatus' => 'Деактивировать статус',
            'activeStatus' => 'Активировать статус'
        ];
    }

    public function deleteSelected(): void
    {
        $surveys = $this->getSelected();
        foreach ($surveys as $key => $value) {
            $survey = Survey::find($value);
            $survey?->delete();
        }
        $this->clearSelected();
    }

    public function deActiveStatus(): void {
        $surveys = $this->getSelected();
        foreach ($surveys as $val) {
            $survey = Survey::find($val);
            $survey->status = false;
            $survey->save();
        }
        $this->clearSelected();
    }
    public function activeStatus(): void {
        $surveys = $this->getSelected();
        foreach ($surveys as $val) {
            $survey = Survey::find($val);
            $survey->status = true;
            $survey->save();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Наименование", "title")
                ->sortable(),
            BooleanColumn::make("Подписки есть", "is_subscription")
                ->sortable(),
            BooleanColumn::make("Статус", "status")
                ->sortable(),
            ButtonGroupColumn::make('Действие')
                ->attributes(function($row) {
                    return [
                        'class' => 'space-x-2 flex',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('survey-question.show', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'fas fa-t btn btn-primary btn-rounded btn-icon flex align-center justify-center items-center',
                            ];
                        }),
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('survey-question-filter.id.locale-id', ['surveyID' => $row, 'localeID' => 1]))
                        ->attributes(function($row) {
                            return [
                                'class' => 'fa fa-line-chart btn btn-primary btn-rounded btn-icon flex align-center justify-center items-center',
                            ];
                        })
                ]),
        ];
    }
}
