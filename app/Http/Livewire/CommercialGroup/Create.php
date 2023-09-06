<?php

namespace App\Http\Livewire\CommercialGroup;

use App\Http\Requests\CommercialGroup\CommercialGroupCreateRequest;
use App\Http\Requests\Group\GroupCreateRequest;
use Bpuig\Subby\Models\Plan;
use Livewire\Component;

class Create extends Component
{
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $tag;
    public $is_active;

    public function mount(){
        $this->title_ru = old("title_ru") ?? "";
        $this->title_kk = old("title_kk") ?? "";
        $this->title_en = old("title_en") ?? "";
        $this->tag = old("tag") ?? "";
        $this->is_active = old("is_active") ?? true;
    }
    protected function rules(){
        return (new CommercialGroupCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.commercial-group.create');
    }
}
