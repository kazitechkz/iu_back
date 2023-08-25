<?php

namespace App\Http\Livewire\Tournament;

use App\Models\File;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Tournament;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class TournamentTable extends DataTableComponent
{
    protected $model = Tournament::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('tournament.edit', $row);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Subject id", "subject.title_ru")
                ->sortable(),
            Column::make("Title ru", "title_ru")
                ->sortable(),
            Column::make("Title kk", "title_kk")
                ->sortable(),
            Column::make("Title en", "title_en")
                ->sortable(),
            Column::make("Rule ru", "rule_ru")
                ->sortable(),
            Column::make("Rule kk", "rule_kk")
                ->sortable(),
            Column::make("Rule en", "rule_en")
                ->sortable(),
            Column::make("Description ru", "description_ru")
                ->sortable(),
            Column::make("Description kk", "description_kk")
                ->sortable(),
            Column::make("Description en", "description_en")
                ->sortable(),
            Column::make("Price", "price")
                ->sortable(),
            Column::make("Currency", "currency")
                ->sortable(),
            Column::make("Poster", "file.url")
                ->format(fn($val) => '<img class="w-50" src="'.File::getFileFromAWS($val).'" />')
                ->html(),
            Column::make("Status", "status")
                ->sortable(),
            Column::make("Start at", "start_at")
                ->sortable(),
            Column::make("End at", "end_at")
                ->sortable(),
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
                        ->location(fn($row) => route('tournament.show', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'fas fa-eye btn btn-primary btn-rounded btn-icon flex align-center justify-center items-center',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn($row) => "")
                        ->location(fn($row) => route('tournament.edit', $row))
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
