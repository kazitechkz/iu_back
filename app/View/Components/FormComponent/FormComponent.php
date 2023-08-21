<?php

namespace App\View\Components\FormComponent;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public string $method;
    public $route;
    public $parameters;
    public string $enctype;
    public string $elementId;

    public bool $isSend = true;
    public bool $isClear = true;

    public function __construct( string $method,
     string $route,
     string $elementId,
     string $enctype = "",
    $parameters = [],
    bool $isSend = true,
    bool $isClear = true,
    )
    {
        $this->method = $method;
        $this->route = $route;
        $this->enctype = $enctype;
        $this->elementId = $elementId;
        $this->parameters = $parameters;
        $this->isSend = $isSend;
        $this->isClear = $isClear;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-component.form-component');
    }
}
