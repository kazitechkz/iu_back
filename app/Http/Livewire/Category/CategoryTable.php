<?php

namespace App\Http\Livewire\Category;

use App\Exports\CategoriesExport;
use App\Helpers\StrHelper;
use App\Models\Subject;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Category;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class CategoryTable extends DataTableComponent
{
    protected $model = Category::class;

    /**
     * @throws DataTableConfigurationException
     */
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,50,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'deleteSelected' => 'Удалить',
            'exportSelected' => 'Export',
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('categories.edit', $row);
            });
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Предмет')
                ->options(Subject::pluck(StrHelper::getTitleAttribute(),"id")->toArray())
                ->filter(function($builder, string $value) {
                    $builder->where(["categories.subject_id"=>$value]);
                }),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Удалить',
            'exportSelected' => 'Export'
        ];
    }

    public function deleteSelected(): void
    {
        $cats = $this->getSelected();
        foreach ($cats as $key => $value) {
            $cat = Category::find($value);
            foreach ($cat->subcategories as $subcategory) {
                $subcategory?->delete();
            }
            $cat?->delete();
        }
        $this->clearSelected();
    }

    public function exportSelected(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $categories = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new CategoriesExport($categories), 'categories.xlsx');
    }

    public function columns(): array
    {
        $title = "title_".\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Наименование", $title)
                ->sortable()->searchable(),
            Column::make("Предмет", "subject.".$title)
                ->sortable()->searchable(),
            Column::make("Создано", "created_at")
                ->sortable(),
        ];
    }
}
