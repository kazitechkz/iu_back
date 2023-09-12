<?php

namespace App\Http\Livewire\SubCategory;

use App\Helpers\StrHelper;
use App\Models\File;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubCategory;

class SubCategoryTable extends DataTableComponent
{
    protected $model = SubCategory::class;

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
                return route('sub-categories.edit', $row);
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
        $cats = $this->getSelected();
        foreach ($cats as $key => $value) {
            $cat = SubCategory::find($value);
            $cat?->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Предмет", "category.subject.".StrHelper::getTitleAttribute())
                ->sortable(),
            Column::make("Категория", "category.".StrHelper::getTitleAttribute())
                ->sortable(),
            Column::make("Наименование", StrHelper::getTitleAttribute())
                ->sortable(),
            Column::make('Image', 'file.url')
                ->format(fn($val) => '<img class="w-50" src="'.File::getFileFromAWS($val).'" />')
                ->html()
        ];
    }
}
