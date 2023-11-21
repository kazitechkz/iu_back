<?php

namespace App\Http\Livewire\Notification;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Notification;

class NotificationTable extends DataTableComponent
{
    protected $model = Notification::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'exportSelected' => 'Export',
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('notification.edit', $row);
            });
    }
    public function deleteSelected()
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = Notification::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.type_id"), "notification_type.title_ru")
                ->sortable(),
            Column::make(__("table.class_id"), "classroom_group.title_ru")
                ->sortable(),
            Column::make(__("table.owner_id"), "owner.name")
                ->sortable(),
            Column::make(__("table.title"), "title")
                ->sortable(),
            Column::make(__("table.message"), "message")
                ->sortable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
        ];
    }
}
