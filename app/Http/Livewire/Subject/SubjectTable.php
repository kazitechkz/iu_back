<?php

namespace App\Http\Livewire\Subject;

use App\Exports\SubjectExports;
use App\Models\Subject;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class SubjectTable extends DataTableComponent
{
    protected $model = Subject::class;
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
                return route('subject.edit', $row);
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
        $subjects = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new SubjectExports($subjects), 'subjects.xlsx');
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Наименование", "title_ru")->searchable()
                ->sortable(),
            BooleanColumn::make("Обязательный компонент", "is_compulsory")
                ->sortable(),
            Column::make('Картинка', 'image.url')->format(function ($value){
                return '<img src="'.$value.'" class="w-50" />';
            })->html(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
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
