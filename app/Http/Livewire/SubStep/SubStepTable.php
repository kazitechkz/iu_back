<?php

namespace App\Http\Livewire\SubStep;

use App\Helpers\StrHelper;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubStep;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class SubStepTable extends DataTableComponent
{
    protected $model = SubStep::class;

    protected $step;

    public function mount($step = null): void
    {
        if($this->step){
            $this->step = $step;
        }
    }

    /**
     * @throws DataTableConfigurationException
     */
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('sub-step.edit', $row);
            });
    }

    public function query()
    {
        if($this->step != null){
            return SubStep::query()->where('step_id', $this->step->id);
        }
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Наименование", StrHelper::getTitleAttribute())
                ->sortable(),
            Column::make("Степ", "step.".StrHelper::getTitleAttribute())
                ->sortable(),
            Column::make("Субстеп", "sub_category.".StrHelper::getTitleAttribute())
                ->sortable(),
            Column::make("Уровень", "level")
                ->sortable(),
            BooleanColumn::make("Активный", "is_active")
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
                        ->location(fn($row) => route('sub-step-test.show', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'fas fa-t btn btn-primary btn-rounded btn-icon flex align-center justify-center items-center',
                            ];
                        }),
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('sub-step-content.show', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'fas fa-k btn btn-primary btn-rounded btn-icon flex align-center justify-center items-center',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn($row) => "")
                        ->location(fn($row) => route('step.edit', $row))
                        ->attributes(function($row) {
                            return [
                                'target' => '_blank',
                                'class' => 'fas fa-pencil btn btn-danger btn-rounded btn-icon flex align-center justify-center items-center',
                            ];
                        }),
                ]),
        ];
    }
}
