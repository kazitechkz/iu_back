<?php

namespace App\Http\Livewire\TutorSkill;

use App\Models\Gender;
use App\Models\News;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TutorSkill;

class TutorSkillTable extends DataTableComponent
{
    protected $model = TutorSkill::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'deleteSelected' => 'Удалить'
        ]);
    }
    public function deleteSelected()
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = TutorSkill::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.tutor"), "tutor.user.name")
                ->sortable(),
            Column::make(__("table.subject_id"), "subject.title_ru")
                ->sortable(),
            Column::make(__("table.category_id"), "category.title_ru")
                ->sortable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),
        ];
    }
}
