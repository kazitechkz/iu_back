<?php

namespace App\Http\Livewire\Tutor;

use App\Exports\NewsExport;
use App\Models\News;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Tutor;

class TutorTable extends DataTableComponent
{
    protected $model = Tutor::class;

    public function configure(): void
    {
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('tutor.edit', $row);
            });
    }

    public function deleteSelected()
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = Tutor::find($value);
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
            Column::make(__("table.user_id"), "user_id")
                ->sortable(),
            Column::make(__("table.image_url"), "image_url")
                ->sortable(),
            Column::make(__("table.gender_id"), "gender_id")
                ->sortable(),
            Column::make(__("table.phone"), "phone")
                ->sortable(),
            Column::make(__("table.email"), "email")
                ->sortable(),
            Column::make(__("table.iin"), "iin")
                ->sortable(),
            Column::make(__("table.birth_date"), "birth_date")
                ->sortable(),
            Column::make(__("table.bio"), "bio")
                ->sortable(),
            Column::make(__("table.experience"), "experience")
                ->sortable(),
            Column::make(__("table.is_proved"), "is_proved")
                ->sortable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
        ];
    }
}
