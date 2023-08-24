<?php

namespace App\Http\Livewire\Tournament;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Tournament;

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
            Column::make("Subject id", "subject_id")
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
            Column::make("Poster", "poster")
                ->sortable(),
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
        ];
    }
}
