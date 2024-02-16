<?php

namespace App\Http\Livewire\IUTubeVideo;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\IUTubeVideo;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class IUTubeVideoTable extends DataTableComponent
{
    protected $model = IUTubeVideo::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
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
            Column::make("Рекомендуемые", "is_recommended")
                ->sortable(),
            Column::make("Создан", "created_at")
                ->sortable(),
            Column::make("Обновлен", "updated_at")
                ->sortable(),
        ];
    }
}
