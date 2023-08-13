<?php

namespace App\View\Components\ErrorComponent;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ValidationError extends Component
{
    /**
     * Create a new component instance.
     */
    public  string $name = "";
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.error-component.validation-error');
    }
}
