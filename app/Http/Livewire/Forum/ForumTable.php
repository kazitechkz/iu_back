<?php

namespace App\Http\Livewire\Forum;

use App\Exports\ForumExport;
use App\Exports\PlanExport;
use App\Models\Subject;
use App\View\Components\Shared\ActionButtons;
use Bpuig\Subby\Models\Plan;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Forum;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ComponentColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ForumTable extends DataTableComponent
{
    protected $model = Forum::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'exportSelected' => 'Export',
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('forum.edit', $row);
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
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = Forum::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }

    public function exportSelected(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $model = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new ForumExport($model), 'forum.xlsx');
    }


    public function filters(): array

    {
        return [
            SelectFilter::make('Subject')
                ->options(Subject::pluck("title_ru","id")->toArray())
                ->filter(function($builder, string $value) {
                    $builder->where(["subject_id"=>$value]);
                }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("table.text"), "text")
                ->sortable(),
            Column::make(__("table.user_id"), "user.name")
                ->sortable(),
            Column::make(__("table.subject_id"), "subject.title_ru")
                ->sortable(),
            Column::make(__("table.created_at"), "created_at")
                ->sortable(),
            Column::make(__("table.updated_at"), "updated_at")
                ->sortable(),



        ];
    }
}
