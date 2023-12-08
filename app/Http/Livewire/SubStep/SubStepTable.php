<?php

namespace App\Http\Livewire\SubStep;

use App\Helpers\StrHelper;
use App\Models\Category;
use App\Models\Step;
use App\Models\Subject;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubStep;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class SubStepTable extends DataTableComponent
{
    protected $model = SubStep::class;

    protected $step;
    protected $selected_subject = 1;
    public function mount($step = null): void
    {
        if($this->step){
            $this->step = $step;
        }
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Предмет')
                ->options(Subject::pluck(StrHelper::getTitleAttribute(),"id")->toArray())
                ->filter(function($builder, string $value) {
                    $builder->whereHas("step",function($q) use ($value){
                        $q->where('subject_id','=',$value);
                    });
                }),

        ];
    }

    /**
     * @throws DataTableConfigurationException
     */
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('sub-step.edit', $row);
            });
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Удалить'
        ];
    }

    public function deleteSelected(): void
    {
        $subSteps = $this->getSelected();
        foreach ($subSteps as $key => $value) {
            $sub = SubStep::find($value);
            $sub?->delete();
        }
        $this->clearSelected();
    }
    public function query()
    {
        if($this->step != null){
            return SubStep::query()->where(['step_id' => $this->step->id, 'deleted_at' => null]);
        }
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Наименование", StrHelper::getTitleAttribute())
                ->searchable(),
//            Column::make("Степ", "step.".StrHelper::getTitleAttribute())
//                ->sortable(),
            Column::make("Субстеп", "sub_category.".StrHelper::getTitleAttribute())
                ->sortable(),
            Column::make("Уровень", "level")
                ->sortable(),
            Column::make("ТЕСТ")
                ->label(fn($val) => $val->total_test_kk),
            Column::make("Контент")
                ->label(fn($val) => $val->content ? '<span class="text-green-500">+</span>' : '<span class="text-red-500">-</span>')
            ->html(),
//            Column::make("На рус")
//                ->label(fn($val) => $val->total_test_ru),
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
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('sub-step-video.show', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'fas fa-b btn btn-primary btn-rounded btn-icon flex align-center justify-center items-center',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn($row) => "")
                        ->location(fn($row) => route('sub-step.edit', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'fas fa-pencil btn btn-danger btn-rounded btn-icon flex align-center justify-center items-center',
                            ];
                        }),
                ]),
        ];
    }
}
