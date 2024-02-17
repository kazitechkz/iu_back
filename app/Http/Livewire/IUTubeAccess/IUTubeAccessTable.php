<?php

namespace App\Http\Livewire\IUTubeAccess;

use App\Models\File;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\IUTubeAccess;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class IUTubeAccessTable extends DataTableComponent
{
    protected $model = IUTubeAccess::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,40,80,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('iutube-access.edit', $row);
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
        $items = $this->getSelected();
        foreach ($items as $key => $value) {
            $model = IUTubeAccess::find($value);
            if ($model) {
                File::deleteFileFromAWS($model->image_url);
            }
            $model?->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Дисциплина", "subject.title_ru")
                ->sortable(),
            BooleanColumn::make("Активен", "is_active")
                ->sortable(),
            Column::make("Создан", "created_at")
                ->sortable(),
            Column::make("Обновлен", "updated_at")
                ->sortable(),
        ];
    }
}
