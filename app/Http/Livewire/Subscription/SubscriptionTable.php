<?php

namespace App\Http\Livewire\Subscription;

use App\Exports\SubscriptionExport;
use App\Models\User;
use Bpuig\Subby\Models\PlanCombination;
use Bpuig\Subby\Models\PlanSubscription;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class SubscriptionTable extends DataTableComponent
{
    protected $model = PlanSubscription::class;


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
                return route('subscription.edit', $row);
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
            $entity = PlanSubscription::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }

    public function exportSelected(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $model = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new SubscriptionExport($model), 'subscription.xlsx');
    }
    public function columns(): array
    {

        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make('Subscriber', 'subscriber_id'),
            Column::make("Name","name")->searchable(),
            Column::make("Description","description")->searchable(),
            Column::make("Price","price")->sortable(),
            Column::make("Currency","currency")->searchable(),
            Column::make("Invoice Period", "invoice_period")
                ->sortable(),
            Column::make("Invoice Interval", "invoice_interval")
                ->sortable(),
            BooleanColumn::make("Trial Period","trial_period")->searchable(),
            Column::make("Trial Interval","trial_interval")->searchable(),
            Column::make("Grace Period","grace_period")->searchable(),
            Column::make("Grace Interval","grace_interval")->searchable(),
            Column::make("Starts At","starts_at")->sortable(),
            Column::make("Ends At","ends_at")->sortable(),
            Column::make("Cancels At","cancels_at")->sortable(),
            Column::make("Canceled At","canceled_at")->sortable(),

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
