<?php

namespace App\View\Components\LayerComponents;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentNavbar extends Component
{
    /**
     * Create a new component instance.
     */

    public string $title;
    public string $subtitle;
    public array $breadcrumbs;
    public function __construct(string $title,string $subtitle, array $breadcrumbs)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layer-components.content-navbar');
    }
}
