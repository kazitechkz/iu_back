<?php

namespace App\Http\Livewire\SubjectContext;

use App\Helpers\StrHelper;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubjectContext;

class SubjectContextTable extends DataTableComponent
{
    protected $model = SubjectContext::class;

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
                return route('subject-contexts.edit', $row);
            });
    }
    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Удалить'
        ];
    }

    public function deleteSelected(): void
    {
        $subjects = $this->getSelected();
        foreach ($subjects as $key => $value) {
            $sub = SubjectContext::find($value);
            $sub?->delete();
        }
        $this->clearSelected();
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Предмет", "subject.title_ru")
                ->sortable()->searchable(),
            Column::make("Контекст", "context")
                ->format(fn($val) => StrHelper::getSubStr($val, 100))
                ->html()
                ->sortable()
                ->searchable()
        ];
    }
}
