<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Ckeditor extends Component
{
    public string $inputName;
    public string $title;
    public string|null $description;

    /**
     * Create a new component instance.
     * @param $inputName
     * @param $title $title for label
     */
    public function __construct($inputName, $title, $description = null)
    {
        $this->inputName = $inputName;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ckeditor');
    }
}
