<?php

namespace App\Http\Livewire\UrlPage;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\UrlPage;

class IndexTable extends DataTableComponent
{
    protected $model = UrlPage::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
            return route('url-pages.edit', $row);
        });
        $this->setBulkActions([
            'deleteSelected' => 'Удалить',
            'import' => 'Import',
        ]);
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Удалить',
            'import' => 'Import',
        ];
    }
    public function import(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        return redirect(route('url-page.get-import'));
    }
    public function deleteSelected(): void
    {
        $urls = $this->getSelected();
        foreach ($urls as $key => $value) {
            $url = UrlPage::find($value);
            $url?->delete();
        }
        $this->clearSelected();
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Наименование", "title")
                ->sortable(),
            Column::make("URL", "url")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
