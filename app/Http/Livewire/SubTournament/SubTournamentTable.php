<?php

namespace App\Http\Livewire\SubTournament;

use App\Models\Discuss;
use Illuminate\Database\Query\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubTournament;

class SubTournamentTable extends DataTableComponent
{
    protected $model = SubTournament::class;
    protected $tournament;

    public function mount($tournament)
    {
        $this->tournament = $tournament;
    }
    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return SubTournament::query()->where('tournament_id', $this->tournament->id);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Tournament id", "tournament.title")
                ->sortable(),
            Column::make("Step id", "tournament_step.title_ru")
                ->sortable(),
            Column::make("Question quantity", "question_quantity")
                ->sortable(),
            Column::make("Max point", "max_point")
                ->sortable(),
            Column::make("Single question quantity", "single_question_quantity")
                ->sortable(),
            Column::make("Multiple question quantity", "multiple_question_quantity")
                ->sortable(),
            Column::make("Context question quantity", "context_question_quantity")
                ->sortable(),
            Column::make("Time", "time")
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
