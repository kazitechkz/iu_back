<?php

namespace App\Http\Livewire\PromocodePlan;

use App\Models\PromocodePlan;
use Livewire\Component;

class Create extends Component
{
    public $title;
    protected $rules = [
        'title' => 'required|unique:promocode_plans,title',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function submit()
    {
        $data = $this->validate();
        PromocodePlan::create(['title' => $data['title']]);
        return redirect(route('promocode-plans.index'));
    }
    public function render()
    {
        return view('livewire.promocode-plan.create');
    }
}
