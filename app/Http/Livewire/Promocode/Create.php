<?php

namespace App\Http\Livewire\Promocode;

use App\Http\Requests\Promocode\PromocodeCreateRequest;
use App\Http\Requests\RoleCreateRequest;
use Livewire\Component;
use Zorb\Promocodes\Models\Promocode;

class Create extends Component
{
    public int $points;
    public int $count;
    public int $usages;
    public $expiration_date;

    public function mount(){
        $this->points = old("points")??1;
        $this->count = old("count")??1;
        $this->usages = old("usages")??1;
        $this->expiration_date = old("expiration_date")??now();
    }
    protected function rules(){
        return (new PromocodeCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {

        return view('livewire.promocode.create');
    }
}
