<?php

namespace App\Http\Livewire\Plan;

use App\Exports\PlanExport;
use Bpuig\Subby\Models\Plan;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

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
            Column::make("Tag", "tag")->searchable()
                ->sortable(),
            Column::make("Name", "name")->searchable()
                ->sortable(),
            Column::make("Is Active", "is_active")->format(function ($value){
                return $value ? "<p class='text-green-500'>Активен</p>" : "<p class='text-red-500'>Не активен</p>";
            })->html(),
            Column::make("Price", "price")->searchable()
                ->sortable(),
            Column::make("Sign Up Fee", "signup_fee")
                ->sortable(),
            Column::make("Currency", "currency")->searchable()
                ->sortable(),
            Column::make("Invoice Period", "invoice_period")
                ->sortable(),
            Column::make("Invoice Interval", "invoice_interval")
                ->sortable(),
            Column::make("Trial Period", "trial_period")
                ->sortable(),
            Column::make("Trial Interval", "trial_interval")
                ->sortable(),
            Column::make("Trial Mode", "trial_mode")
                ->sortable(),
            Column::make("Grace Period", "grace_period")
                ->sortable(),
            Column::make("Grace Interval", "grace_interval")
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
