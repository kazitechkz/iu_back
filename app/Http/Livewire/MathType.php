<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MathType extends Component
{
    public string $text = 'Вставить формулу';
    public $show;

    public function toggle()
    {
        $this->show = !$this->show;
        if ($this->show) {
            $this->text = 'Скрыть';
        } else {
            $this->text = 'Вставить формулу';
        }
    }
    public function render()
    {
        return view('livewire.math-type');
    }
}
