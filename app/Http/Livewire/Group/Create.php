<?php

namespace App\Http\Livewire\Group;

use App\Http\Requests\Group\GroupCreateRequest;
use Bpuig\Subby\Models\Plan;
use Livewire\Component;

class Create extends Component
{
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $isActive;
    public $plans;
    public $planGroups;

    public function mount(){
        $this->plans = Plan::all();
        $this->title_ru = old("title_ru") ?? "";
        $this->title_kk = old("title_kk") ?? "";
        $this->title_en = old("title_en") ?? "";
        $this->isActive = old("isActive") ?? true;
        $this->planGroups = [];
    }
    protected function rules(){
        return (new GroupCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.group.create');
    }
}
