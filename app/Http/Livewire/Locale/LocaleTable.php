<?php

namespace App\Http\Livewire\Locale;

use App\Exports\LocaleExport;
use App\Exports\SubjectExports;
use App\Models\Locale;
use App\Models\Subject;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class LocaleTable extends DataTableComponent
{
    protected $model = Locale::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,50,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'exportSelected' => 'Export',
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('locale.edit', $row);
            });
    }
    public function bulkActions(): array
    {
        return [
            'exportSelected' => 'Export',
            'deleteSelected' => 'Удалить'
        ];
    }

    public function deleteSelected()
    {
        $locales = $this->getSelected();
        foreach ($locales as $key => $value) {
            $locale = Locale::find($value);
            $locale?->delete();
        }
        $this->clearSelected();
    }

    public function exportSelected(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $locales = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new LocaleExport($locales), 'locales.xlsx');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Title", "title")
                ->searchable()
                ->sortable(),
            Column::make("Code", "code")
                ->searchable()

                ->sortable(),
            Column::make("IsActive", "isActive")->format(function ($value){
                return $value ? "<p class='text-green-500'>Активен</p>" : "<p class='text-red-500'>Не активен</p>";
            })->html(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
