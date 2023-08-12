<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainSidebarMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public string $link;
    public string $name;
    public  string $icon;
    public function __construct(string $icon, string $link, string $name)
    {
        $this->icon = $icon;
        $this->name = $name;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.main-sidebar-menu');
    }
}
