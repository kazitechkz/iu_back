<?php

namespace App\Http\Livewire\SubStepVideo;

use App\Helpers\StrHelper;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubStepVideo;

class Table extends DataTableComponent
{
    protected $model = SubStepVideo::class;

    /**
     * @throws DataTableConfigurationException
     */
    public function configure(): void
    {
        $this->setDefaultSort('sub_step_video.created_at', 'desc');
        $this->setPerPageAccepted([20,50,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('sub-step-video.edit', $row);
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
        $questions = $this->getSelected();
        foreach ($questions as $key => $value) {
            $question = SubStepVideo::find($value);
            $question?->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Субстеп", "sub_step.".StrHelper::getTitleAttribute())
                ->sortable()
                ->searchable(),
            Column::make("Url", "url")
                ->sortable(),
        ];
    }
}
