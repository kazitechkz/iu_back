<?php

namespace App\Http\Livewire\IUTubeAuthor;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\IUTubeAuthor;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class IUTubeAuthorTable extends DataTableComponent
{
    protected $model = IUTubeAuthor::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Image url", "image_url")
                ->sortable(),
            Column::make("Имя", "name")
                ->searchable(),
            BooleanColumn::make("Активен", "is_active")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
