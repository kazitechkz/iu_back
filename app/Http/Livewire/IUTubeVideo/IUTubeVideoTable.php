<?php

namespace App\Http\Livewire\IUTubeVideo;

use App\Models\File;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\IutubeVideo;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class IUTubeVideoTable extends DataTableComponent
{
    protected $model = IutubeVideo::class;

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
                return route('iutube-video.edit', $row);
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
            $model = IUTubeVideo::find($value);
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
            Column::make("Ссылка", "alias")
                ->sortable(),
            Column::make("Наименование", "title")
                ->sortable(),
            Column::make("Автор", "iutube_author.name")
                ->sortable(),
            Column::make("Язык", "locale.title")
                ->sortable(),
            Column::make("Предмет", "subject.title_ru")
                ->sortable(),
            Column::make("Ссылка", "video_url")
                ->searchable(),
            Column::make("Цена", "price")
                ->searchable(),
            BooleanColumn::make("Доступ открыт всем", "is_public")
                ->sortable(),
            BooleanColumn::make("Рекомендуемые", "is_recommended")
                ->sortable(),
            Column::make("Создан", "created_at")
                ->sortable(),
            Column::make("Обновлен", "updated_at")
                ->sortable(),
        ];
    }
}
