<?php

namespace App\Http\Livewire\Announcement;

use App\Models\AnnouncementGroup;
use App\Models\File;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Announcement;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class AnnouncementTable extends DataTableComponent
{
    protected $model = Announcement::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('announcement.edit', $row);
            });
    }
    public function deleteSelected()
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = Announcement::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Удалить'
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Type id", "announcement_type.title_".\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale())
                ->sortable(),
            Column::make("Group id", "group.title_".\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale())
                ->searchable(),
            Column::make("Background", "image.url")
                ->format(fn($val) => '<img class="w-50" src="'.File::getFileFromAWS($val).'" />')
                ->html(),
            Column::make("Title", "title")
                ->searchable(),
            Column::make("Sub title", "sub_title")
                ->sortable(),
            Column::make("Description", "description")
                ->html()
                ->searchable(),
            Column::make("Time in sec", "time_in_sec")
                ->sortable(),
            Column::make("Url text", "url_text")
                ->sortable(),
            Column::make("Url", "url")
                ->sortable(),
        ];
    }
}
