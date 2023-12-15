<?php

namespace App\Http\Livewire\Appeal;

use App\Models\Appeal;
use App\Models\AppealType;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $types;
    public $type_id = 0;

    public function mount()
    {
        $this->types = AppealType::all();
    }
    public function render()
    {
        return view('livewire.appeal.index', [
            'appeals' => $this->type_id == 0 ? Appeal::paginate(10) : Appeal::where('type_id', $this->type_id)->paginate(10)
        ]);
    }
}
