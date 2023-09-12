<?php

namespace App\Http\Livewire\TutorSkill;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TutorSkill;

class TutorSkillTable extends DataTableComponent
{
    protected $model = TutorSkill::class;

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
            Column::make("Subject id", "subject_id")
                ->sortable(),
            Column::make("Category id", "category_id")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
