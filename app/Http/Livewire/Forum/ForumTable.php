<?php

namespace App\Http\Livewire\Forum;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Forum;

class ForumTable extends DataTableComponent
{
    protected $model = Forum::class;

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
            Column::make("Subject id", "subject_id")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
