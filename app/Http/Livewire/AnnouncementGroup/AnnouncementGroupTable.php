<?php

namespace App\Http\Livewire\AnnouncementGroup;

use App\Models\AnnouncementType;
use App\Models\File;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\AnnouncementGroup;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class AnnouncementGroupTable extends DataTableComponent
{
    protected $model = AnnouncementGroup::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('announcement-group.edit', $row);
            });
    }
    public function deleteSelected()
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = AnnouncementGroup::find($value);
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
            Column::make(__("table.title_ru"), "title_ru")
                ->searchable(),
            Column::make(__("table.title_kk"), "title_kk")
                ->searchable(),
            Column::make(__("table.title_en"), "title_en")
                ->searchable(),
            BooleanColumn::make(__("table.is_active"), "is_active")
                ->sortable(),
            Column::make(__("table.image_url"), "file.url")
                ->format(fn($val) => '<img class="w-50" src="'.File::getFileFromAWS($val).'" />')
                ->html(),
            Column::make(__("table.start_at"), "start_date")
                ->sortable(),
            Column::make(__("table.end_at"), "end_date")
                ->sortable(),
            Column::make(__("table.order"), "order")
                ->sortable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
        ];
    }
}
