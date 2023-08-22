<?php

namespace App\Http\Livewire\DiscussRating;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\DiscussRating;

class DiscussRatingTable extends DataTableComponent
{
    protected $model = DiscussRating::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Rating", "rating")
                ->sortable(),
            Column::make("User id", "user.name")
                ->sortable(),
            Column::make("Discuss id", "discuss.text")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
