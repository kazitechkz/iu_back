<?php

namespace App\Http\Livewire\Permission;

use App\Exports\SubjectExports;
use App\Models\Subject;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTable extends  DataTableComponent
{
    protected $model = Permission::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'exportSelected' => 'Export',
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('permission.edit', $row);
            });
    }






    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Наименование", "name")->searchable()
                ->sortable(),
            Column::make("Guard Name", "guard_name")->searchable()
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
