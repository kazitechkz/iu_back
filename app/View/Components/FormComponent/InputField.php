<?php

namespace App\View\Components\FormComponent;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputField extends Component
{
    /**
     * Create a new component instance.
     */
    public string $elementId = "";
    public string $label = "";
    public bool $required = true;
    public string $name = "";
    public string $type = "";
    public string $placeholder = "";
    public string $value = "";
    public function __construct(
        string $elementId = "",
        string $label = "",
        bool $required = true,
        string $name = "",
        string $type = "",
        string $placeholder = "",
        string $value = ""
    )
    {
        $this->elementId = $elementId;
        $this->label = $label;
        $this->required = $required;
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-component.input-field');
    }
}
