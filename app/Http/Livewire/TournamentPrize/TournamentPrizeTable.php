<?php

namespace App\Http\Livewire\TournamentPrize;

use App\Models\Tournament;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TournamentPrize;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TournamentPrizeTable extends DataTableComponent
{
    protected $model = TournamentPrize::class;

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
            $entity = TournamentPrize::find($value);
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

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Удалить'
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Наименование (RU)", "title_ru")
                ->searchable(),
            BooleanColumn::make("Виртуальный", "is_virtual")
                ->sortable(),
                Column::make("Турнир", "tournament.title_ru")
                ->sortable(),
            Column::make("Номер", "order")
                ->sortable(),
            Column::make("Место с", "start_from")
                ->sortable(),
            Column::make("До", "end_to")
                ->sortable(),
            Column::make("Значение", "value")
                ->sortable(),
        ];
    }
}
