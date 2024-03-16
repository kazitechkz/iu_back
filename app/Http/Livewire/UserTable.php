<?php

namespace App\Http\Livewire;
use App\Exports\UsersExport;
use Bpuig\Subby\Models\Plan;
use Database\Seeders\UserRoleSeeder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Spatie\Permission\Models\Role;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,50,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'import' => 'Import',
            'exportSelected' => 'Export',
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('user.edit', $row);
            });
    }

    public function filters(): array

    {
        return [
            SelectFilter::make(__("table.role_id"))
                ->options(Role::pluck("name","id")->toArray())
                ->filter(function($builder, string $value) {
                    $user_ids = DB::table("model_has_roles")->where("role_id",$value)->pluck("model_id")->toArray();
                    $builder->whereIn("id",$user_ids);
                }),

        ];
    }
    public function bulkActions(): array
    {
        return [
            'import' => 'Импорт',
            'exportSelected' => 'Экспорт',
        ];
    }

    public function import(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        return redirect(route('get-user-import'));
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
            Column::make(__("table.user_name"), "name")->searchable()
                ->sortable(),
            Column::make(__("table.phone"), "phone")->searchable()
                ->sortable(),
            Column::make(__("table.Email"), "email")->searchable()
                ->sortable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),

        ];
    }
}
