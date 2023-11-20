<?php

namespace App\Http\Livewire\Announcement;

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
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Type id", "type_id")
                ->sortable(),
            Column::make("Group id", "group.title_".\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale())
                ->sortable(),
            Column::make("Background", "image.url")
                ->format(fn($val) => '<img class="w-50" src="'.File::getFileFromAWS($val).'" />')
                ->html(),
            Column::make("Title", "title_".\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale())
                ->sortable(),
            Column::make("Sub title", "sub_title")
                ->sortable(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make("Time in sec", "time_in_sec")
                ->sortable(),
            Column::make("Url text", "url_text")
                ->sortable(),
            Column::make("Url", "url")
                ->sortable(),
            ButtonGroupColumn::make('Действие')
                ->attributes(function($row) {
                    return [
                        'class' => 'space-x-2 flex',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => '')
                        ->location(fn($row) => route('step.show', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'fas fa-plus btn btn-primary btn-rounded btn-icon flex align-center justify-center items-center',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn($row) => "")
                        ->location(fn($row) => route('step.edit', $row))
                        ->attributes(function($row) {
                            return [
                                'target' => '_blank',
                                'class' => 'fas fa-pencil btn btn-danger btn-rounded btn-icon flex align-center justify-center items-center',
                            ];
                        }),
                ]),
        ];
    }
}
