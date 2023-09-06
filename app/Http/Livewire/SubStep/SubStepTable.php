<?php

namespace App\Http\Livewire\SubStep;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubStep;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class SubStepTable extends DataTableComponent
{
    protected $model = SubStep::class;

    protected $step;

    public function mount($step = null)
    {
        if($this->step){
            $this->step = $step;
        }
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('sub-step.edit', $row);
            });
    }

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        if($this->step != null){
            return SubStep::query()->where('step_id', $this->step->id);
        }
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Title ru", "title_ru")
                ->sortable(),
            Column::make("Title kk", "title_kk")
                ->sortable(),
            Column::make("Title en", "title_en")
                ->sortable(),
            Column::make("Step id", "step.title_ru")
                ->sortable(),
            Column::make("Sub category id", "sub_category.title_ru")
                ->sortable(),
            Column::make("Level", "level")
                ->sortable(),
            BooleanColumn::make("Is active", "is_active")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
