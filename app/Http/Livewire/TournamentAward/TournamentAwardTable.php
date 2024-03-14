<?php

namespace App\Http\Livewire\TournamentAward;

use App\Models\Tournament;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TournamentAward;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TournamentAwardTable extends DataTableComponent
{
    protected $model = TournamentAward::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('tournament-prize.edit', $row);
            });
    }
    public function deleteSelected()
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = TournamentAward::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }

    public function filters(): array

    {
        return [
            SelectFilter::make('Tournament')
                ->options(Tournament::pluck("title_ru","id")->toArray())
                ->filter(function($builder, string $value) {
                    $builder->where(["tournament_id"=>$value]);
                }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Наименование ru", "title_ru")
                ->sortable(),
            Column::make("Наименование kk", "title_kk")
                ->sortable(),
            Column::make("Наименование en", "title_en")
                ->sortable(),
            BooleanColumn::make("Выдан", "is_awarded")
                ->sortable(),
            Column::make("Турнир", "tournament.title_ru")
                ->sortable(),
            Column::make("Пользователь", "user.name")
                ->sortable(),
            Column::make("Номер", "order")
                ->sortable(),
        ];
    }
}
