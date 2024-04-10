<?php

namespace App\Http\Livewire\Information;

use App\Models\File;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Information;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class InformationTable extends DataTableComponent
{
    protected $model = Information::class;

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
                return route('information.edit', $row);
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
            $model = Information::find($value);
            $model?->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Ссылка", "alias")
                ->sortable(),
            Column::make(__("table.author_id"), "information_author.name")
                ->sortable(),
            Column::make(__("table.category_id"), "information_category.title_ru")
                ->sortable(),
            Column::make(__("table.image_url"), 'file.url')
                ->format(fn($val) => '<img class="w-50" src="'.File::getFileFromAWS($val).'" />')
                ->html(),
            Column::make("Seo Заголовок", "seo_title")
                ->sortable(),
            Column::make("Seo Описание", "seo_description")
                ->sortable(),
            Column::make("Seo Ключевые слова", "seo_keywords")
                ->sortable(),
            Column::make(__("table.title_ru"), "title_ru")
                ->sortable(),
            Column::make(__("table.title_kk"), "title_kk")
                ->sortable(),
            BooleanColumn::make(__("table.is_active"), "is_active")
                ->sortable(),
            BooleanColumn::make("На главной", "is_main")
                ->sortable(),
            Column::make(__('table.published_at'), "published_at")
                ->sortable(),
            Column::make(__('table.created_at'), "created_at")
                ->sortable(),
            Column::make(__('table.updated_at'), "updated_at")
                ->sortable(),
        ];
    }
}
