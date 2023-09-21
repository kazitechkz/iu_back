<?php

namespace App\Http\Livewire\Subject;

use App\AppConstants\AppConstants;
use App\Exports\SubjectExports;
use App\Models\File;
use App\Models\Subject;
use Maatwebsite\Excel\Facades\Excel;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class SubjectTable extends DataTableComponent
{
    protected $model = Subject::class;

    /**
     * @throws DataTableConfigurationException
     */
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,50,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'exportSelected' => 'Export',
            'deleteSelected' => 'Удалить'
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
            'deleteSelected' => 'Удалить'
        ];
    }

    public function deleteSelected(): void
    {
        $subjects = $this->getSelected();
        foreach ($subjects as $key => $value) {
            $sub = Subject::find($value);
            if ($sub) {
                File::deleteFileFromAWS($sub->image_url);
            }
            $sub?->delete();
        }
        $this->clearSelected();
    }

    public function exportSelected(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $subjects = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new SubjectExports($subjects), 'subjects.xlsx');
    }
    public function columns(): array
    {
        $title = "title_".\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Наименование", $title)
                ->searchable()
                ->sortable(),
            BooleanColumn::make("Обязательный компонент", "is_compulsory")
                ->sortable(),
            Column::make("Мах кол-во вопросов", "max_questions_quantity")
                ->sortable(),
//            Column::make('Image', 'image.url')
//                ->format(fn($val) => '<img class="w-50" src="https://iunion.s3.ap-south-1.amazonaws.com/subjects/onw.png" />')
//                ->html()
            Column::make('Image', 'image.url')
                ->format(fn($val) => '<img class="w-50" src="'.File::getFileFromAWS($val).'" />')
                ->html()

//            Column::make("Created at", "created_at")
//                ->sortable(),
//            Column::make("Updated at", "updated_at")
//                ->sortable(),
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
