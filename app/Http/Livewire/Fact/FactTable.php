<?php

namespace App\Http\Livewire\Fact;

use App\Models\Locale;
use App\Models\QuestionType;
use App\Models\Subject;
use App\Services\LanguageService;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Fact;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class FactTable extends DataTableComponent
{
    protected $model = Fact::class;

    /**
     * @throws DataTableConfigurationException
     */
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,50,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('fact.edit', $row);
            });
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Удалить'
        ];
    }

    public function filters(): array
    {
        $options = [0 => 'Выберите предмет', Subject::pluck('title_ru', 'id')->toArray()];
        return [
            SelectFilter::make('Предмет')
                ->options(Subject::pluck('title_ru', 'id')->toArray())
                ->filter(function ($builder, string $value){
                    $builder->where(['facts.subject_id' => $value]);
                })
        ];
    }
    public function deleteSelected(): void
    {
        $facts = $this->getSelected();
        foreach ($facts as $key => $value) {
            $fact = Fact::find($value);
            $fact?->delete();
        }
        $this->clearSelected();
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable(),
            Column::make("Предмет", "subject.title_kk")
                ->sortable(),
            Column::make("Text kk", "text_kk")
                ->sortable()
                ->searchable(),
            Column::make("Text ru", "text_ru")
                ->sortable()
                ->searchable()
        ];
    }
}
