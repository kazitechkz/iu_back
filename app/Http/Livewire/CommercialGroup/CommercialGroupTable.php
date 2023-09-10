<?php

namespace App\Http\Livewire\CommercialGroup;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CommercialGroup;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class CommercialGroupTable extends DataTableComponent
{
    protected $model = CommercialGroup::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('commercial-group.edit', $row);
            });
    }
    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Удалить'
        ];
    }

    public function deleteSelected()
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = CommercialGroup::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.title_ru"), "title_ru")
                ->sortable(),
            Column::make(__("table.title_kk"), "title_kk")
                ->sortable(),
            Column::make(__("table.title_en"), "title_en")
                ->sortable(),
            Column::make(__("table.tag"), "tag")
                ->sortable(),
            BooleanColumn::make(__("table.is_active"), "is_active")
                ->sortable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
        ];
    }
}
