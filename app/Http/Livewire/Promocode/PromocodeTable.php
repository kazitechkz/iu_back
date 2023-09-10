<?php

namespace App\Http\Livewire\Promocode;

use App\Exports\PromocodeExport;
use App\Exports\SubscriptionExport;
use Bpuig\Subby\Models\PlanSubscription;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Spatie\Permission\Models\Role;
use Zorb\Promocodes\Models\Promocode;

class PromocodeTable extends  DataTableComponent
{
    protected $model = Promocode::class;

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
                return route('promocode.show', $row);
            });
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

    public function bulkActions(): array
    {
        return [
            'exportSelected' => 'Export',
            'deleteSelected' => 'Удалить'
        ];
    }
    public function exportSelected(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $model = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new PromocodeExport($model), 'promocodes.xlsx');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.code"), "code")->searchable()
                ->sortable(),
            Column::make("Details")->format(function ($value){
               return $value["points"] . " IU Coins";
            }),
            BooleanColumn::make(__("table.is_active"), "usages_left")
                ->sortable(),
            Column::make(__("table.usages"), "usages_left")
                ->sortable(),
            Column::make(__("table.user_id"), "user.name"),
            Column::make(__("table.user_id"), "user.name")
                ->sortable(),
            Column::make(__("table.expiration"),"expired_at")->sortable(),
            Column::make(__("table.created_at"),"created_at")->sortable(),
            Column::make(__("table.updated_at"),"updated_at"),
        ];
    }

}
