<?php

namespace App\Http\Livewire\Plan;

use App\Exports\PlanExport;
use Bpuig\Subby\Models\Plan;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class PlanTable extends  DataTableComponent
{
    protected $model = Plan::class;

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
                return route('plan.edit', $row);
            });
    }
    public function bulkActions(): array
    {
        return [
            'exportSelected' => 'Export',
            'deleteSelected' => 'Удалить'
        ];
    }

    public function deleteSelected()
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = Plan::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }

    public function exportSelected(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $model = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new PlanExport($model), 'plan.xlsx');
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.tag"), "tag")->searchable()
                ->sortable(),
            Column::make(__("table.name"), "name")->searchable()
                ->sortable(),
            BooleanColumn::make(__("table.is_active"), "is_active"),
            Column::make(__("table.price"), "price")->searchable()
                ->sortable(),
            Column::make(__("table.sign_up_fee"), "signup_fee")
                ->sortable(),
            Column::make(__("table.currency"), "currency")->searchable()
                ->sortable(),
            Column::make(__("table.invoice_period"), "invoice_period")
                ->sortable(),
            Column::make(__("table.invoice_interval"), "invoice_interval")
                ->sortable(),
            Column::make(__("table.trial_period"), "trial_period")
                ->sortable(),
            Column::make(__("table.trial_interval"), "trial_interval")
                ->sortable(),
            Column::make("Trial Mode", "trial_mode")
                ->sortable(),
            Column::make(__("table.grace_period"), "grace_period")
                ->sortable(),
            Column::make(__("table.grace_interval"), "grace_interval")
                ->sortable(),
        ];
    }

    protected function results(): array
    {
        return [
            // The table results configuration.
            // As results are optional on tables, you may delete this method if you do not use it.
        ];
    }
}
