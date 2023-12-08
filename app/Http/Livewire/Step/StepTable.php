<?php

namespace App\Http\Livewire\Step;

use App\Helpers\StrHelper;
use App\Models\Category;
use App\Models\File;
use App\Models\Subject;
use App\Models\Tournament;
use App\Models\TournamentStep;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Step;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class StepTable extends DataTableComponent
{
    protected $model = Step::class;

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
                return route('step.edit', $row);
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
        $steps = $this->getSelected();
        foreach ($steps as $key => $value) {
            $step = Step::with('sub_steps')->find($value);
            if ($step->sub_steps) {
                foreach ($step->sub_steps as $sub_step) {
                    $sub_step->delete();
                }
            }
            $step?->delete();
        }
        $this->clearSelected();
    }

    public function filters(): array

    {
        return [
            SelectFilter::make('Предмет')
                ->options(Subject::pluck(StrHelper::getTitleAttribute(),"id")->toArray())
                ->filter(function($builder, string $value) {
                    $builder->where(["steps.subject_id"=>$value]);
                }),

//            SelectFilter::make('Категория')
//                ->options(Category::pluck(StrHelper::getTitleAttribute(),"id")->toArray())
//                ->filter(function($builder, string $value) {
//                    $builder->where(["steps.category_id"=>$value]);
//                }),
        ];
    }



    public function columns(): array
    {

        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Наименование", StrHelper::getTitleAttribute())
                ->searchable(),
            Column::make("Предмет", "subject.".StrHelper::getTitleAttribute())
                ->sortable(),
            Column::make("Категория", "category.".StrHelper::getTitleAttribute())
                ->sortable(),
            Column::make("Уровень", "level")
                ->sortable(),
            BooleanColumn::make("Бесплатный", "is_free")
                ->sortable(),
            BooleanColumn::make("Активный", "is_active")
                ->sortable(),
            Column::make("Картинка", "file.url")
                ->format(fn($val) => '<img class="w-50" src="'.File::getFileFromAWS($val).'" />')
                ->html(),
            ButtonGroupColumn::make('Действие')
                ->attributes(function($row) {
                    return [
                        'class' => 'space-x-2 flex',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('step.show', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'fas fa-plus btn btn-primary btn-rounded btn-icon flex align-center justify-center items-center',
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
