<?php

namespace App\Http\Livewire\Cash;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Cash;

class IndexTable extends DataTableComponent
{
    protected $model = Cash::class;
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("ID пользователя", "user_id")
                ->sortable()
                ->searchable(),
            Column::make("Имя", "user.name")
                ->sortable()->searchable(),
            Column::make("Баланс", "balance")
                ->sortable(),
            Column::make("Дата создания", "created_at")
                ->sortable(),
            Column::make("Дата обновления", "updated_at")
                ->sortable(),
        ];
    }
}
