<?php

namespace App\Http\Livewire\CareerQuizCoupons;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CareerCoupon;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class CareerQuizCouponTable extends DataTableComponent
{
    protected $model = CareerCoupon::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,40,80,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('career-quiz-coupon.edit', $row);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.user"), "user.name")
                ->sortable(),
            Column::make(__("table.order"), "order_id")
                ->searchable(),
            Column::make("Группа профориентации", "career_quiz_group.title_ru")
                ->sortable(),
            Column::make("Профориентации", "career_quiz.title_ru")
                ->sortable(),
            BooleanColumn::make("Использован", "is_used")
                ->sortable(),
            BooleanColumn::make("Статус", "status")
                ->sortable(),
        ];
    }
}
