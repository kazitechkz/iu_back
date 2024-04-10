<?php

namespace App\Http\Livewire\Information;

use App\Http\Requests\Information\InformationCreateRequest;
use App\Models\Information;
use App\Models\InformationAuthor;
use App\Models\InformationCategory;
use Livewire\Component;

class Edit extends Component
{
    public $information;
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

    public function mount(Information $information){
        $this->information = $information;
        $this->categories = InformationCategory::all();
        $this->authors = InformationAuthor::all();
        $this->category_id = $this->information->category_id;
        $this->author_id = $this->information->author_id;
        $this->seo_title = $this->information->seo_title;
        $this->seo_description = $this->information->seo_description;
        $this->seo_keywords = $this->information->seo_keywords;
        $this->title_ru = $this->information->title_ru;
        $this->title_kk = $this->information->title_kk;
        $this->description_ru = $this->information->description_ru;
        $this->description_kk = $this->information->description_kk;
        $this->is_active = $this->information->is_active;
        $this->is_main = $this->information->is_main;
        $this->published_at = $this->information->published_at;
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
        return view('livewire.information.edit');
    }
}
