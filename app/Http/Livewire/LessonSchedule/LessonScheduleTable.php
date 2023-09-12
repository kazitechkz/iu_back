<?php

namespace App\Http\Livewire\LessonSchedule;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\LessonSchedule;

class LessonScheduleTable extends DataTableComponent
{
    protected $model = LessonSchedule::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('lesson-schedule.edit', $row);
            });
        $this->setBulkActions([
            'deleteSelected' => 'Удалить'
        ]);
    }
    public function deleteSelected()
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = LessonSchedule::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.tutor"), "tutor.user.name")
                ->sortable(),
            Column::make(__("table.start_at"), "start_at")
                ->sortable(),
            Column::make(__("table.end_at"), "end_at")
                ->sortable(),
            Column::make(__("table.price"), "price")
                ->sortable(),
            Column::make(__("table.amount"), "amount")
                ->sortable(),
            Column::make(__("table.meeting_info"), "meeting_info")
                ->sortable(),
            Column::make(__("table.cancel_from"), "cancel_from")
                ->sortable(),
            Column::make(__("table.is_canceled"), "is_cancelled")
                ->sortable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
        ];
    }
}
