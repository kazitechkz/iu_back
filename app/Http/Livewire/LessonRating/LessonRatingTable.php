<?php

namespace App\Http\Livewire\LessonRating;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\LessonRating;

class LessonRatingTable extends DataTableComponent
{
    protected $model = LessonRating::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Participant id", "participant_id")
                ->sortable(),
            Column::make("Rating", "rating")
                ->sortable(),
            Column::make("Review", "review")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
