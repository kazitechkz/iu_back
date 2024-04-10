<?php

namespace App\Http\Livewire\InformationAuthor;

use App\Models\File;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\InformationAuthor;

class InformationAuthorTable extends DataTableComponent
{
    protected $model = InformationAuthor::class;

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
                return route('information-author.edit', $row);
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
            $model = InformationAuthor::find($value);
            if ($model->image_url) {
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
            Column::make("Имя", "name")
                ->sortable(),
            Column::make(__("table.image_url"), 'file.url')
                ->format(fn($val) => '<img class="w-50" src="'.File::getFileFromAWS($val).'" />')
                ->html(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
