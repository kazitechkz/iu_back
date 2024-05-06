<?php

namespace App\Http\Livewire\Cash;

use App\Models\Cash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CashWithdrawal;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class WithdrawTable extends DataTableComponent
{
    protected $model = CashWithdrawal::class;

    /**
     * @throws DataTableConfigurationException
     */
    public function configure(): void
    {
        $this->setDefaultSort('created_at', 'desc');
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,50,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'resetToZero' => 'Обнулить'
        ]);
    }
    public function bulkActions(): array
    {
        return [
            'resetToZero' => 'Обнулить'
        ];
    }

    public function resetToZero()
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = CashWithdrawal::find($value);
            $entity->cash->balance = 0;
            $entity->cash->save();
            $entity->status = 1;
            $entity->save();
        }
        $this->clearSelected();
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("ID пользователя", "user_id")
                ->sortable()->searchable(),
            Column::make("Имя", "user.name")
                ->sortable()->searchable(),
            Column::make("Сумма вывода", "balance")->format(
                fn($value, $row, Column $column) => !$row->status ? '<span class="text-green-500">'.$value.'</span>' : '<span class="text-red-500">-'.$value.'</span>'
            )->html(),
            Column::make("Статус", 'status')->format(
                fn($value, $row, Column $column) => $value ? '<span class="text-green-500">Успешно</span>' : '<span class="text-yellow-500">В ожидании</span>'
            )->html(),
            Column::make("Дата создания", "created_at")
                ->sortable(),
            Column::make("Дата обнуления", "updated_at")
                ->sortable(),
        ];
    }
}
