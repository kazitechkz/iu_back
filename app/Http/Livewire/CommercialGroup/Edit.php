<?php

namespace App\Http\Livewire\CommercialGroup;

use App\Http\Requests\CommercialGroup\CommercialGroupUpdateRequest;
use App\Http\Requests\Group\GroupCreateRequest;
use App\Models\CommercialGroup;
use Livewire\Component;

class Edit extends Component
{
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $tag;
    public $is_active;
    public $commercial_group_id;
    public CommercialGroup $commercial_group;

    public function mount(CommercialGroup $commercial_group){
        $this->commercial_group = $commercial_group;
        $this->commercial_group_id = $commercial_group->id;
        $this->title_ru = $commercial_group->title_ru ?? "";
        $this->title_kk = $commercial_group->title_kk ?? "";
        $this->title_en = $commercial_group->title_en ?? "";
        $this->tag = $commercial_group->tag ?? "";
        $this->is_active = $commercial_group->is_active ?? true;
    }
    protected function rules(){
        return (new CommercialGroupUpdateRequest())->rules($this->commercial_group->id);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.commercial-group.edit');
    }
}
