<?php

namespace App\Http\Livewire\SubjectRelation;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubjectRelation;

class SubjectRelationTable extends DataTableComponent
{
    protected $model = SubjectRelation::class;

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
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("SubjectId", "subject_id")
                ->sortable(),
            Column::make("RelationId", "relation_id")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
