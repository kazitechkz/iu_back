<?php

namespace App\Http\Livewire\Step;

use App\Models\Category;
use App\Models\File;
use App\Models\Subject;
use App\Models\Tournament;
use App\Models\TournamentStep;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Step;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class StepTable extends DataTableComponent
{
    protected $model = Step::class;
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('step.edit', $row);
            });
    }

    public function filters(): array

    {
        return [
            SelectFilter::make('Subject')
                ->options(Subject::pluck("title_ru","id")->toArray())
                ->filter(function($builder, string $value) {
                    $builder->where(["steps.subject_id"=>$value]);
                }),

            SelectFilter::make('Category')
                ->options(Category::pluck("title_ru","id")->toArray())
                ->filter(function($builder, string $value) {
                    $builder->where(["steps.category_id"=>$value]);
                }),
        ];
    }



    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Title ru", "title_ru")
                ->sortable(),
            Column::make("Title kk", "title_kk")
                ->sortable(),
            Column::make("Title en", "title_en")
                ->sortable(),
            Column::make("Subject id", "subject.title_ru")
                ->sortable(),
            Column::make("Category id", "category.title_ru")
                ->sortable(),
            Column::make("Plan id", "plan.name")
                ->sortable(),
            Column::make("Level", "level")
                ->sortable(),
            BooleanColumn::make("Is free", "is_free")
                ->sortable(),
            BooleanColumn::make("Is active", "is_active")
                ->sortable(),
            Column::make("Image url", "file.url")
                ->format(fn($val) => '<img class="w-50" src="'.File::getFileFromAWS($val).'" />')
                ->html(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            ButtonGroupColumn::make('Actions')
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
                                'class' => 'fas fa-eye btn btn-primary btn-rounded btn-icon flex align-center justify-center items-center',
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
