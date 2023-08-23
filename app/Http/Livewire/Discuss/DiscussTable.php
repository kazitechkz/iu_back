<?php

namespace App\Http\Livewire\Discuss;

use App\Exports\DiscussExport;
use App\Exports\ForumExport;
use App\Models\Forum;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Discuss;
use function Symfony\Component\Translation\t;

class DiscussTable extends DataTableComponent
{
    protected $model = Discuss::class;
    protected $forum;


    public function mount($forum)
    {
        $this->forum = $forum;
    }
    public function query(): Builder
    {
        return Discuss::query()->where('forum_id', $this->forum->id);
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'exportSelected' => 'Export',
            'deleteSelected' => 'Удалить'
        ]);
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
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = Discuss::find($value);
            $entity?->delete();
        }
        $this->clearSelected();
    }

    public function exportSelected(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $model = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new DiscussExport($model), 'discuss.xlsx');
    }


    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Text", "text")
                ->sortable(),
            Column::make("User id", "user.name")
                ->sortable(),
            Column::make("Forum id", "forum.text")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
