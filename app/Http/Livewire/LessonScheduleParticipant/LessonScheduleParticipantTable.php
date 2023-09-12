<?php

namespace App\Http\Livewire\LessonScheduleParticipant;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\LessonScheduleParticipant;

class LessonScheduleParticipantTable extends DataTableComponent
{
    protected $model = LessonScheduleParticipant::class;

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
            Column::make("Schedule id", "schedule_id")
                ->sortable(),
            Column::make("Is presented", "is_presented")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
