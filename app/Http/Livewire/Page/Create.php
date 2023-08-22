<?php

namespace App\Http\Livewire\Page;

use App\Http\Requests\Page\PageCreateRequest;
use App\Models\Locale;
use Livewire\Component;

class Create extends Component
{
    public string $title;
    public string $code;
    public string $content;
    public bool $isActive;
    public int|null $locale_id;
    public  $locales;

    public function mount(){
        $this->locales = Locale::where(["isActive" => true])->get();
        $this->title = old("title")??"";
        $this->code = old("code")??"";
        $this->content = old("content")??"";
        $this->isActive = old("isActive")??false;
        $this->locale_id = old("locale_id")??null;
    }


    protected function rules(){
        return (new PageCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.page.create');
    }
}
