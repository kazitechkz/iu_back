<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public string $elementId;
    public string $name;
    public  string $icon;
    public function __construct(string $icon, string $elementId, string $name)
    {
        $this->icon = $icon;
        $this->name = $name;
        $this->elementId = $elementId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.sidebar-menu');
    }
}
