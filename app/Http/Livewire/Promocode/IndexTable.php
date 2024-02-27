<?php

namespace App\Http\Livewire\Promocode;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Promocode;

class IndexTable extends DataTableComponent
{
    protected $model = Promocode::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setBulkActions([
            'deleteSelected' => 'Удалить'
        ]);
    }
    public function deleteSelected()
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = Promocode::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Code", "code")
                ->sortable(),
            Column::make("Expired at", "expired_at")
                ->sortable(),
//            Column::make("Plan ids", "plan_ids")
//                ->sortable(),
//            Column::make("Group ids", "group_ids")
//                ->sortable(),
            Column::make("Percentage", "percentage")
                ->sortable(),
            Column::make("Details", "details")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
