<?php

namespace App\Http\Livewire\Tutor;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Tutor;

class TutorTable extends DataTableComponent
{
    protected $model = Tutor::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("User id", "user_id")
                ->sortable(),
            Column::make("Image url", "image_url")
                ->sortable(),
            Column::make("Gender id", "gender_id")
                ->sortable(),
            Column::make("Phone", "phone")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Iin", "iin")
                ->sortable(),
            Column::make("Birth date", "birth_date")
                ->sortable(),
            Column::make("Bio", "bio")
                ->sortable(),
            Column::make("Experience", "experience")
                ->sortable(),
            Column::make("Skills", "skills")
                ->sortable(),
            Column::make("Is proved", "is_proved")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
