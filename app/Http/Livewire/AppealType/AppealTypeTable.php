<?php

namespace App\Http\Livewire\AppealType;

use App\Exports\AppealTypeExport;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\AppealType;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class AppealTypeTable extends DataTableComponent
{
    protected $model = AppealType::class;

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
                return route('appeal-type.edit', $row);
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
            $entity = AppealType::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }

    public function exportSelected(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $model = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new AppealTypeExport($model), 'appeal_type.xlsx');
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
            BooleanColumn::make("IsActive", "isActive")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
