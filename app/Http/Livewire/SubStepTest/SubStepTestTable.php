<?php

namespace App\Http\Livewire\SubStepTest;

use App\Helpers\StrHelper;
use App\Models\Question;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubStepTest;

class SubStepTestTable extends DataTableComponent
{
    protected $model = SubStepTest::class;

    /**
     * @throws DataTableConfigurationException
     */
    public function configure(): void
    {
        $this->setDefaultSort('sub_step_tests.created_at', 'desc');
        $this->setPerPageAccepted([20,50,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
//            'exportSelected' => 'Export',
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('sub-step-test.edit', $row);
            });
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
            $question = SubStepTest::find($value);
            $question->question?->delete();
            $question?->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Подраздел", "sub_step.title_ru")
                ->sortable(),
            Column::make('Вопрос', 'question.text')
                ->format(fn($val) => StrHelper::getSubStr($val, 30))
                ->html()
                ->searchable(),
            Column::make("Создан", "created_at")
                ->sortable(),
        ];
    }
}
