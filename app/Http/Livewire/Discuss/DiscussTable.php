<?php

namespace App\Http\Livewire\Discuss;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Discuss;

class DiscussTable extends DataTableComponent
{
    protected $model = Discuss::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Text", "text")
                ->sortable(),
            Column::make("User id", "user.name")
                ->sortable(),
            Column::make("Forum id", "forum.text")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
