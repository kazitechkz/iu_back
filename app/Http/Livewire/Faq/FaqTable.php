<?php

namespace App\Http\Livewire\Faq;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Faq;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class FaqTable extends DataTableComponent
{
    protected $model = Faq::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,50,100]);
        $this->setPerPage(20);

        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('faq.edit', $row);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.question_id"), "question")
                ->sortable(),
            Column::make(__("table.answer"), "answer")
                ->sortable(),
            BooleanColumn::make(__("table.is_active"), "is_active")
                ->sortable(),
            Column::make(__("table.locale_id"), "locale.title")
                ->sortable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
        ];
    }
}
