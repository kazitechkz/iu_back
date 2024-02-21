<?php

namespace App\Http\Livewire\SubTournamentResult;

use App\Models\Tournament;
use App\Models\TournamentStep;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubTournamentResult;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class SubTournamentResultTable extends DataTableComponent
{
    protected $model = SubTournamentResult::class;

    protected $tournament_id = 0;
    protected $step_id = 0;
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100,200]);
        $this->setBulkActions([
            'deleteSelected' => 'Удалить'
        ]);
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
            $sub = SubTournamentResult::find($value);
            $sub?->delete();
        }
        $this->clearSelected();
    }
    public function filters(): array

    {
        return [
            SelectFilter::make('Tournament')
                ->options(Tournament::pluck("title_ru","id")->toArray())
                ->filter(function($builder, string $value) {
                    $this->tournament_id = $value;
                    $builder->whereHas('sub_tournament', function ($query) use ($value) {
                        $args = ["tournament_id"=>$this->tournament_id];
                        if($this->step_id){
                            $args["step_id"] = $this->step_id;
                        }
                        return $query->where($args);
                    });
                }),
            SelectFilter::make('Step')
                ->options(TournamentStep::pluck("title_ru","id")->toArray())
                ->filter(function($builder, string $value) {
                    $this->step_id = $value;
                    $builder->whereHas('sub_tournament', function ($query) use ($value) {
                        $args = ["step_id"=>$this->step_id];
                        if($this->tournament_id){
                            $args["tournament_id"] = $this->tournament_id;
                        }
                        return $query->where($args);
                    });
                }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.user_id"), "user.name")
                ->sortable(),
            Column::make(__("table.tournament_step_id"), "sub_tournament.tournament_step.title_ru")
                ->sortable(),
            Column::make(__("table.point"), "point")
                ->sortable(),
            Column::make(__("table.time"), "time")
                ->sortable(),
            Column::make(__("table.attempt_id"), "attempt_id")
                ->sortable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
        ];
    }
}
