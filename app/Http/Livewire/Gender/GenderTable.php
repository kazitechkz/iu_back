<?php

namespace App\Http\Livewire\Gender;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Gender;

class GenderTable extends DataTableComponent
{
    protected $model = Gender::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('gender.edit', $row);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.title_ru"), "title_ru")
                ->sortable(),
            Column::make(__("table.title_kk"), "title_kk")
                ->sortable(),
            Column::make(__("table.title_en"), "title_en")
                ->sortable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
        ];
    }
}
