<?php

namespace App\Http\Livewire\NotificationType;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\NotificationType;

class NotificationTypeTable extends DataTableComponent
{
    protected $model = NotificationType::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('notification-type.edit', $row);
            });
    }
    public function deleteSelected()
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = NotificationType::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Удалить'
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.value"), "value")
                ->searchable(),
            Column::make(__("table.title_ru"), "title_ru")
                ->searchable(),
            Column::make(__("table.title_kk"), "title_kk")
                ->searchable(),
            Column::make(__("table.title_en"), "title_en")
                ->searchable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
        ];
    }
}
