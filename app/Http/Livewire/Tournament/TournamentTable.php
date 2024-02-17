<?php

namespace App\Http\Livewire\Tournament;

use App\Models\File;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Tournament;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class TournamentTable extends DataTableComponent
{
    protected $model = Tournament::class;

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
                return route('tournament.show', $row);
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
            $sub = Tournament::find($value);
            $sub?->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.subject_id"), "subject.title_ru")
                ->sortable(),
            Column::make(__("table.title_ru"), "title_ru")
                ->sortable(),
            Column::make(__("table.title_kk"), "title_kk")
                ->sortable(),
            Column::make(__("table.text_en"), "title_en")
                ->sortable(),
            Column::make(__("table.price"), "price")
                ->sortable(),
            Column::make(__("table.currency"), "currency")
                ->sortable(),
            Column::make(__("table.poster"), "file.url")
                ->format(fn($val) => '<img class="w-50" src="'.File::getFileFromAWS($val).'" />')
                ->html(),
            Column::make(__("table.status"), "status")
                ->sortable(),
            Column::make(__("table.start_at"), "start_at")
                ->sortable(),
            Column::make(__("table.end_at"), "end_at")
                ->sortable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
            ButtonGroupColumn::make(__("table.updated_at"))
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
