<?php

namespace App\Http\Livewire\SubCategory;

use App\Helpers\StrHelper;
use App\Models\File;
use App\Models\Subject;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubCategory;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

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

    public function filters(): array
    {
        return [
            SelectFilter::make('Предмет')
                ->options(Subject::pluck(StrHelper::getTitleAttribute(),"id")->toArray())
                ->filter(function($builder, string $value) {
                    $builder->whereHas("category",function($q) use ($value){
                        $q->where('subject_id','=',$value);
                    });
                }),
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
                ->sortable()
                ->searchable(),
            Column::make('Image', 'file.url')
                ->format(fn($val) => '<img class="w-50" src="'.File::getFileFromAWS($val).'" />')
                ->html()
        ];
    }
}
