<?php

namespace App\Http\Livewire\Promocode;

use App\Models\Hub;
use App\Models\Promocode;
use App\Models\PromocodePlan;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public string $code;
    public $expired_at;
    public $plan_ids;
    public $plans;
    public $group_ids;
    public $groups;
    public $percentage;
    public $details;
    protected $rules = [
        'code' => 'required|unique:promocodes,code',
        'expired_at' => 'required',
        'percentage' => 'required|numeric'
    ];
    public function generate()
    {
        $this->code = Str::upper(Str::random(6));
    }
    public function mount() {
        $this->groups = Hub::all();
        $this->plans = PromocodePlan::all();
    }
    public function updatedCode()
    {
        $this->code = Str::upper($this->code);
    }
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $data['code'] = $this->code;
        $data['percentage'] = $this->percentage;
        $data['expired_at'] = Carbon::create($this->expired_at);
        if ($this->group_ids) {
            $data['group_ids'] = $this->group_ids;
        }
        if ($this->plan_ids) {
            $data['plan_ids'] = $this->plan_ids;
        }
        Promocode::add($data);
        return redirect(route('promocode.index'));
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.promocode.create');
    }
}
