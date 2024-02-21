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
        $this->setBulkActions([
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('sub-tournament.edit', $row);
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
        $subjects = $this->getSelected();
        foreach ($subjects as $key => $value) {
            $sub = SubTournament::find($value);
            $sub?->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.tournament_id"), "tournament.title_ru")
                ->sortable(),
            Column::make(__("table.tournament_step_id"), "tournament_step.title_ru")
                ->sortable(),
            Column::make(__("table.question_quantity"), "question_quantity")
                ->sortable(),
            Column::make(__("table.max_point"), "max_point")
                ->sortable(),
            Column::make(__("table.single_question_quantity"), "single_question_quantity")
                ->sortable(),
            Column::make(__("table.multiple_question_quantity"), "multiple_question_quantity")
                ->sortable(),
            Column::make(__("table.context_question_quantity"), "context_question_quantity")
                ->sortable(),
            Column::make(__("table.time"), "time")
                ->sortable(),
            Column::make(__("table.start_at"), "start_at")
                ->sortable(),
            Column::make(__("table.end_at"), "end_at")
                ->sortable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
        ];
    }
}
