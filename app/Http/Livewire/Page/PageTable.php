<?php

namespace App\Http\Livewire\Page;

use App\Exports\PageExport;
use App\Exports\PlanExport;
use Bpuig\Subby\Models\Plan;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Page;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class PageTable extends DataTableComponent
{
    protected $model = Page::class;

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
                return route('page.edit', $row);
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
            $entity = Page::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }

    public function exportSelected(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $model = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new PageExport($model), 'page.xlsx');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__('table.title'), "title")
                ->sortable(),
            BooleanColumn::make(__('table.is_active'), "isActive")
                ->sortable(),
            Column::make(__('table.locale_id'), "locale.title")
                ->sortable(),
            Column::make(__('table.code'), "code")
                ->sortable(),
            Column::make(__('table.created_at'), "created_at")
                ->sortable(),
            Column::make(__('table.updated_at'), "updated_at")
                ->sortable(),
        ];
    }
}
