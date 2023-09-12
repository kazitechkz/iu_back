<?php

namespace App\Http\Livewire\LessonComplaint;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\LessonComplaint;

class LessonComplaintTable extends DataTableComponent
{
    protected $model = LessonComplaint::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Tutor id", "tutor_id")
                ->sortable(),
            Column::make("Participant id", "participant_id")
                ->sortable(),
            Column::make("Schedule id", "schedule_id")
                ->sortable(),
            Column::make("Complaint", "complaint")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
