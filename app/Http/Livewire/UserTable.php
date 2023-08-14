<?php

namespace App\Http\Livewire;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,50,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'exportSelected' => 'Export',
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('user.edit', $row);
            });
    }
    public function bulkActions(): array
    {
        return [
            'exportSelected' => 'Export',
        ];
    }

    public function exportSelected()
    {
        $users = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new UsersExport($users), 'users.xlsx');
    }
    public function columns(): array
    {
        return [

            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")->searchable()
                ->sortable(),
            Column::make("Phone", "phone")->searchable()
                ->sortable(),
            Column::make("Email", "email")->searchable()
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),

        ];
    }
}
