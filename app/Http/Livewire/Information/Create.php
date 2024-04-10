<?php

namespace App\Http\Livewire\Information;

use App\Http\Requests\Information\InformationCreateRequest;
use App\Http\Requests\InformationAuthor\InformationAuthorCreateRequest;
use App\Models\InformationAuthor;
use App\Models\InformationCategory;
use Livewire\Component;

class Create extends Component
{
    public $author_id;
    public $authors;
    public $category_id;
    public $categories;
    public $image_url;
    public $seo_title;
    public $seo_description;
    public $seo_keywords;
    public $title_ru;
    public $title_kk;
    public $description_ru;
    public $description_kk;
    public $is_active;
    public $is_main;
    public $published_at;

    public function mount(){
        $this->categories = InformationCategory::all();
        $this->authors = InformationAuthor::all();
        $this->category_id = old("category_id");
        $this->author_id = old("author_id");
        $this->seo_title = old("seo_title");
        $this->seo_description = old("seo_description");
        $this->seo_keywords = old("seo_keywords");
        $this->title_ru = old("title_ru");
        $this->title_kk = old("title_kk");
        $this->description_ru = old("description_ru");
        $this->description_kk = old("description_kk");
        $this->is_active = old("is_active");
        $this->is_main = old("is_main");
        $this->published_at = old("published_at");
    }

    protected function rules(){
        return (new InformationCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.information.create');
    }
}
