<?php

namespace App\Http\Livewire\Appeal;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ContentAppeal;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class ContentTable extends DataTableComponent
{
    protected $model = ContentAppeal::class;

    public function configure(): void
    {
        $this->setDefaultSort('content_appeals.created_at', 'desc');
        $this->setPrimaryKey('id');
        $this->setBulkActions([
            'changeStatus' => 'Изменить статус'
        ]);
    }
    public function bulkActions(): array
    {
        return [
            'changeStatus' => 'Изменить статус'
        ];
    }

    public function changeStatus(): void
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = ContentAppeal::find($value);
            $entity->status = !$entity->status;
            $entity->save();
        }
        $this->clearSelected();
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable(),
            Column::make("Контент каз", "sub_step_content.text_kk")
                ->sortable()
                ->searchable(),
            Column::make("Контент рус", "sub_step_content.text_ru")
                ->sortable()
                ->searchable(),
            BooleanColumn::make("Статус", "status")
                ->sortable(),
//            Column::make("Description", "description")
//                ->sortable(),
            Column::make("Дата создания", "created_at")
                ->sortable(),
//            Column::make("Updated at", "updated_at")
//                ->sortable(),
            ButtonGroupColumn::make('Действие')
                ->attributes(function($row) {
                    return [
                        'class' => 'space-x-2 flex',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => null)
                        ->location(fn($row) =>
                            route('sub-step-content.edit', (ContentAppeal::find($row->id))->content_id)
                        )
                        ->attributes(function($row) {
                            return [
                                'class' => 'fas fa-k btn btn-primary btn-rounded btn-icon flex align-center justify-center items-center',
                            ];
                        })
                ]),
        ];
    }
}
