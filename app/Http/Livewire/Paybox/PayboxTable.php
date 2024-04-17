<?php

namespace App\Http\Livewire\Paybox;

use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PayboxOrder;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class PayboxTable extends DataTableComponent
{
    protected $model = PayboxOrder::class;

    public function configure(): void
    {
        $this->setDefaultSort('paybox_orders.created_at', 'desc');
        $this->setPrimaryKey('id');
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Статус транзакции')
                ->options([
                    '' => 'Все',
                    '0' => 'Ошибка',
                    '1' => 'Успешно'
                ])
                ->filter(function ($builder, string $value){
                    $builder->where(['status' => $value]);
                }),
            DateFilter::make('Дата покупки')
                ->filter(function ($builder, string $value){
                    $builder->whereBetween('paybox_orders.created_at', [Carbon::create($value)->startOfDay(), Carbon::create($value)->endOfDay()]);
                })
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Пользователь", "user.name")
                ->sortable(),
            Column::make("Цена", "price")
                ->sortable(),
            BooleanColumn::make("Статус", "status")
                ->sortable(),
            Column::make("Промокод", "promo")
                ->sortable(),
            Column::make("Дата инициализации", "created_at")
                ->sortable(),
        ];
    }
}
