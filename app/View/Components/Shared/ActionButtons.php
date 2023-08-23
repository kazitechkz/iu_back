<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButtons extends Component
{
    public string|null $showLink;
    public string|null $editLink;
    public string|null $deleteLink;

    /**
     * Create a new component instance.
     * @param null $showLink $show route
     * @param null $editLink $edit route
     * @param null $deleteLink $delete route
     */
    public function __construct($showLink = null, $editLink = null, $deleteLink = null)
    {
        $this->showLink = $showLink;
        $this->editLink = $editLink;
        $this->deleteLink = $deleteLink;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.action-buttons');
    }
}
