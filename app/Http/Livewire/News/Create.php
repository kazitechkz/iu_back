<?php

namespace App\Http\Livewire\News;

use App\Http\Requests\News\NewsCreateRequest;
use App\Models\Locale;
use Livewire\Component;

class Create extends Component
{
    public string $title;
    public string $subtitle;
    public $image_url;
    public $poster;
    public $locale_id;
    public string $description;
    public bool $is_active;
    public bool $is_important;
    public $published_at;
    public $locales;

    public function mount(){
        $this->locales = Locale::where("isActive",true)->get();
        $this->title = old("title")??"";
        $this->subtitle = old("subtitle")??"";
        $this->description = old("description")??"";
    }
    protected function rules(){
        $rules = (new NewsCreateRequest())->rules();
        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.news.create');
    }
}
