<?php

namespace App\Http\Livewire\SubStepContent;

use App\Helpers\StrHelper;
use App\Models\SubStep;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubStepContent;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class SubStepContentTable extends DataTableComponent
{
    protected $model = SubStepContent::class;
    protected $sub_step;

    public function mount($sub_step = null)
    {
        if($this->sub_step){
            $this->sub_step = $sub_step;
        }
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('sub-step-content.edit', $row);
            });
    }
    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        if($this->sub_step != null){
            return SubStepContent::query()->where('sub_step_id', $this->sub_step->id);
        }
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Текст", StrHelper::getTextAttribute())
                ->format(fn($val) => StrHelper::getSubStr($val, 30))
                ->html()
                ->searchable(),
            Column::make("Субстеп", "sub_step.".StrHelper::getTitleAttribute())
                ->sortable(),
            BooleanColumn::make("Активный", "sub_step.is_active")
                ->sortable()
        ];
    }
}
