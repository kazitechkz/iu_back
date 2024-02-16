<?php

namespace App\Http\Livewire\IUTubeAccess;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\IUTubeAccess;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class IUTubeAccessTable extends DataTableComponent
{
    protected $model = IUTubeAccess::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Дисциплина", "subject_id")
                ->sortable(),
            BooleanColumn::make("Активен", "is_active")
                ->sortable(),
            Column::make("Создан", "created_at")
                ->sortable(),
            Column::make("Обновлен", "updated_at")
                ->sortable(),
        ];
    }
}
