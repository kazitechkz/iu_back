<?php

namespace App\Http\Livewire\TechSupportTicket;

use App\Http\Livewire\TechSupportType\TechSupportTypeTable;
use App\Models\TechSupportCategory;
use App\Models\TechSupportType;
use App\Models\Tournament;
use App\Models\TournamentStep;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TechSupportTicket;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TechSupportTicketTable extends DataTableComponent
{
    protected $model = TechSupportTicket::class;

    public function filters(): array

    {
        return [
            SelectFilter::make('Type')
                ->options(TechSupportType::pluck("title_ru","id")->toArray())
                ->filter(function($builder, string $value) {
                    $builder->where(["type_id"=>$value]);
                }),
            SelectFilter::make('Category')
                ->options(TechSupportCategory::pluck("title_ru","id")->toArray())
                ->filter(function($builder, string $value) {
                    $builder->where(["category_id"=>$value]);
                }),
            SelectFilter::make('Is Answered')
                ->options([true=>"Yes",false=>"No"])
                ->filter(function($builder, string $value) {
                    $builder->where(["is_answered"=>$value]);
                }),
            SelectFilter::make('Is Resolved')
                ->options([true=>"Yes",false=>"No"])
                ->filter(function($builder, string $value) {
                    $builder->where(["is_resolved"=>$value]);
                }),
            SelectFilter::make('Is Closed')
                ->options([true=>"Yes",false=>"No"])
                ->filter(function($builder, string $value) {
                    $builder->where(["is_closed"=>$value]);
                }),
        ];
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('tech-support-ticket.edit', $row);
            });
    }
    public function deleteSelected()
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = TechSupportTicket::find($value);
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
            Column::make("Type id", "tech_support_type.title_ru")
                ->sortable(),
            Column::make("Category id", "tech_support_category.title_ru")
                ->sortable(),
            Column::make("User id", "user.name")
                ->sortable(),
            Column::make("Title", "title")
                ->searchable(),
            BooleanColumn::make("Is closed", "is_closed")
                ->sortable(),
            BooleanColumn::make("Is resolved", "is_resolved")
                ->sortable(),
            BooleanColumn::make("Is answered", "is_answered")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
