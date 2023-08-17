<?php

namespace App\Http\Livewire\PlanCombination;

use Bpuig\Subby\Models\PlanCombination;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PlanCombinationTable extends DataTableComponent
{
    protected $model = PlanCombination::class;

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
                return route('plan-combination.edit', $row);
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
            $entity = PlanCombination::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }

    public function exportSelected(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $model = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new PlanCombination($model), 'plan-combination.xlsx');
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Plan", "plan.name")->searchable()
                ->sortable(),
            Column::make("Tag", "tag")->searchable()
                ->sortable(),
            Column::make("Country", "country")->searchable()
                ->sortable(),
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
