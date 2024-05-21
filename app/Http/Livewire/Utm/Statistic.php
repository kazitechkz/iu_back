<?php

namespace App\Http\Livewire\Utm;

use App\Models\UrlPage;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Statistic extends Component
{
    public $allPages;
    public $pages;
    public $page;
    public $dateTitle = 'За все время';
    public $date;

    public function mount()
    {
        $this->pages = UrlPage::withSum('utms', 'count')->orderBy('utms_sum_count', 'desc')->get();
        $this->allPages = UrlPage::all();
    }

    public function updatedDate()
    {
        $this->filteredMethod();
    }

    public function updatedPage()
    {
        $this->filteredMethod();
    }
    public function render()
    {
        return view('livewire.utm.statistic');
    }

    /**
     * @return void
     */
    public function filteredMethod(): void
    {
        $date = $this->date;
        if ($date) {
            $this->dateTitle = $this->date;
            if ($this->page != 0) {
                $this->pages = UrlPage::where('id', $this->page)->withSum(['utms' => function ($query) use ($date) {
                    $query->where('visit_date', $date);
                }], 'count')->orderBy('utms_sum_count', 'desc')->get();
            } else {
                $this->pages = UrlPage::withSum(['utms' => function ($query) use ($date) {
                    $query->where('visit_date', $date);
                }], 'count')->orderBy('utms_sum_count', 'desc')->get();
            }
        } else {
            $this->dateTitle = 'За все время';
            if ($this->page != 0) {
                $this->pages = UrlPage::where('id', $this->page)->withSum('utms', 'count')->orderBy('utms_sum_count', 'desc')->get();
            } else {
                $this->pages = UrlPage::withSum('utms', 'count')->orderBy('utms_sum_count', 'desc')->get();
            }
        }
    }
}
