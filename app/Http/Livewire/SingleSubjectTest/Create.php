<?php

namespace App\Http\Livewire\SingleSubjectTest;

use App\Exports\SubjectExports;
use App\Models\Subject;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SingleSubjectTest;

class Create extends DataTableComponent
{
    protected $model = SingleSubjectTest::class;

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
                return route('single-subject-tests.edit', $row);
            });
    }

    public function bulkActions(): array
    {
        return [
            'exportSelected' => 'Export',
            'deleteSelected' => 'Удалить'
        ];
    }

    public function deleteSelected()
    {
        $subjects = $this->getSelected();
        foreach ($subjects as $key => $value) {
            $sub = Subject::find($value);
//            if ($sub) {
//                $sub->enable = 0;
//                $sub->save();
//                $sub->delete();
//            }
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
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Предмет", "subject.title_ru")->searchable()
                ->sortable(),
            Column::make("Кол-во вопросов с 1 ответом", "single_answer_questions_quantity")
                ->sortable(),
            Column::make("Кол-во контекстных вопросов", "contextual_questions_quantity")
                ->sortable(),
            Column::make("Кол-во вопросов с несколькими ответами", "multi_answer_questions_quantity")
                ->sortable(),
            Column::make("Отведенное время (мин)", "allotted_time")
                ->sortable(),
//            Column::make("Created at", "created_at")
//                ->sortable(),
//            Column::make("Updated at", "updated_at")
//                ->sortable(),
        ];
    }
}
