<?php

namespace App\Http\Livewire\Category;

use App\Helpers\StrHelper;
use App\Models\Subject;
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
            'deleteSelected' => 'Удалить'
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
            'deleteSelected' => 'Удалить'
        ];
    }

    public function deleteSelected()
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
