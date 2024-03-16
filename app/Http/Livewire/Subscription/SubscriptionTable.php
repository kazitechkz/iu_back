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
            'import' => 'Import',
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
            'import' => 'Импорт',
            'exportSelected' => 'Экспорт',
            'deleteSelected' => 'Удалить'
        ];
    }
    public function import(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        return redirect(route('get-subs-import'));
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
            Column::make(__("table.user_id"), 'subscriber_id'),
            Column::make(__("table.name"),"name")->searchable(),
//            Column::make(__("table.description"),"description")->searchable(),
            Column::make(__("table.price"),"price")->sortable(),
//            Column::make(__("table.currency"),"currency")->searchable(),
//            Column::make(__("table.invoice_period"), "invoice_period")
//                ->sortable(),
//            Column::make(__("table.invoice_interval"), "invoice_interval")
//                ->sortable(),
//            BooleanColumn::make(__("table.trial_period"),"trial_period")->searchable(),
//            Column::make(__("table.trial_interval"),"trial_interval")->searchable(),
//            Column::make(__("table.grace_period"),"grace_period")->searchable(),
//            Column::make(__("table.grace_interval"),"grace_interval")->searchable(),
            Column::make(__("table.start_at"),"starts_at")->sortable(),
            Column::make(__("table.end_at"),"ends_at")->sortable(),
//            Column::make(__("table.cancel_at"),"cancels_at")->sortable(),
//            Column::make((__("table.cancel_at")),"canceled_at")->sortable(),

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
