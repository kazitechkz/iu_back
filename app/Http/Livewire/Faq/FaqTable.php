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
            Column::make("Question", "question")
                ->sortable(),
            Column::make("Answer", "answer")
                ->sortable(),
            BooleanColumn::make("Is active", "is_active")
                ->sortable(),
            Column::make("Locale id", "locale.title")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
