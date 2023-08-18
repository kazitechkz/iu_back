<?php

namespace App\Http\Livewire\News;

use App\Http\Requests\News\NewsUpdateRequest;
use App\Models\Locale;
use App\Models\News;
use Livewire\Component;

class Edit extends Component
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
    public News $news;

    public function mount(News $news){
        $this->news = $news;
        $this->locales = Locale::where("isActive",true)->get();
        $this->title = $this->news->title;
        $this->subtitle = $this->news->subtitle;
        $this->description = $this->news->description;
        $this->published_at = $this->news->published_at;
        $this->locale_id = $this->news->locale_id;
        $this->is_active = $this->news->is_active;
        $this->is_important = $this->news->is_important;

    }
    protected function rules(){
        $rules = (new NewsUpdateRequest())->rules();
        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.news.edit');
    }
}
