<?php

namespace App\Http\Livewire\Utm;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Utm;

class IndexTable extends DataTableComponent
{
    protected $model = Utm::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Page id", "page_id")
                ->sortable(),
            Column::make("Count", "count")
                ->sortable(),
            Column::make("Visit date", "visit_date")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
