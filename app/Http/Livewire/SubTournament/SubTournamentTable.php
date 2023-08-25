<?php

namespace App\Http\Livewire\SubTournament;

use App\Models\Discuss;
use App\Models\Subject;
use App\Models\Tournament;
use App\Models\TournamentStep;
use Illuminate\Database\Query\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubTournament;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class SubTournamentTable extends DataTableComponent
{
    protected $model = SubTournament::class;
    protected $tournament;

    public function mount($tournament = null)
    {
        if($tournament){
            $this->tournament = $tournament;
        }
    }

    public function filters(): array

    {
        return [
            SelectFilter::make('Tournament')
                ->options(Tournament::pluck("title_ru","id")->toArray())
                ->filter(function($builder, string $value) {
                    $builder->where(["tournament_id"=>$value]);
                }),
            SelectFilter::make('Step')
                ->options(TournamentStep::pluck("title_ru","id")->toArray())
                ->filter(function($builder, string $value) {
                    $builder->where(["step_id"=>$value]);
                }),
        ];
    }
    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        if($this->tournament != null){
            return SubTournament::query()->where('tournament_id', $this->tournament->id);
        }
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('sub-tournament.edit', $row);
            });
    }


    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Tournament id", "tournament.title_ru")
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
