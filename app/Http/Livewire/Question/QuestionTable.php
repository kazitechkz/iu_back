<?php

namespace App\Http\Livewire\Question;

use App\Helpers\StrHelper;
use App\Models\Locale;
use App\Models\Subject;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Question;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class QuestionTable extends DataTableComponent
{
    protected $model = Question::class;

    /**
     * @throws DataTableConfigurationException
     */
    public function configure(): void
    {
        $this->setDefaultSort('questions.created_at', 'desc');
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,50,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
//            'exportSelected' => 'Export',
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('questions.edit', $row);
            });
        $this->setConfigurableAreas([
            'toolbar-right-start' => [
                'livewire.question.dropdown-table'
            ]
        ]);
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Язык')
                ->options(Subject::pluck('title_ru', 'id')->toArray())
                ->filter(function ($builder, string $value){
                    $builder->where(['questions.subject_id' => $value]);
                }),
            SelectFilter::make('Язык')
                ->options(Locale::pluck('title', 'id')->toArray())
                ->filter(function ($builder, string $value){
                    $builder->where(['locale_id' => $value]);
                }),
        ];
    }

    public function bulkActions(): array
    {
        return [
//            'exportSelected' => 'Export',
            'deleteSelected' => 'Удалить'
        ];
    }

    public function deleteSelected(): void
    {
        $questions = $this->getSelected();
        foreach ($questions as $key => $value) {
            $question = Question::find($value);
            $question?->delete();
        }
        $this->clearSelected();
    }

//    public function exportSelected(): \Symfony\Component\HttpFoundation\BinaryFileResponse
//    {
//        $subjects = $this->getSelected();
//        $this->clearSelected();
//        return Excel::download(new SubjectExports($subjects), 'questions.xlsx');
//    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
//            Column::make('Категория', 'category.title_ru')
//                ->format(fn($val) => StrHelper::getSubStr($val, 30))
//                ->html()
//                ->searchable(),
            Column::make('Вопрос', 'text')
                ->format(fn($val) => StrHelper::getSubStr($val, 30))
                ->html()
                ->searchable(),
//            Column::make('Контекст', 'context')
//                ->format(fn($val) => StrHelper::getSubStr($val, 30))
//                ->html()
//                ->searchable(),
            Column::make("Язык", "locale.title")
                ->sortable(),
            Column::make("Предмет", "subject.title_ru")
                ->sortable()
                ->searchable(),
            Column::make("Тип вопроса", "type.title_ru")
                ->sortable(),
//            Column::make("Created at", "created_at")
//                ->sortable(),
//            Column::make("Updated at", "updated_at")
//                ->sortable(),
        ];
    }
}
