<?php

namespace App\Http\Livewire\SubTournamentRival;

use App\Models\Tournament;
use App\Models\TournamentStep;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubTournamentRival;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class SubTournamentRivalTable extends DataTableComponent
{
    protected $model = SubTournamentRival::class;
    protected $tournament_id = 0;
    protected $step_id = 0;
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100,200]);
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
            Column::make("Tournament", "sub_tournament.tournament.title_ru")
                ->sortable(),
            Column::make("Sub Tournament", "sub_tournament.tournament_step.title_ru")
                ->sortable(),
            Column::make("Rival one", "rivalOne.name")
                ->sortable(),
            Column::make("Point one", "point_one")
                ->sortable(),
            Column::make("Time one", "time_one")
                ->sortable(),
            Column::make("Rival two", "rivalTwo.name")
                ->sortable(),
            Column::make("Point two", "point_two")
                ->sortable(),
            Column::make("Time two", "time_two")
                ->sortable(),
            Column::make("Winner", "user.name")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
