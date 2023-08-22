<?php

namespace App\Http\Livewire\Page;

use App\Http\Requests\Page\PageCreateRequest;
use App\Http\Requests\Page\PageUpdateRequest;
use App\Models\Locale;
use App\Models\Page;
use Livewire\Component;

class Edit extends Component
{
    public string $title;
    public string $code;
    public string $content;
    public bool $isActive;
    public int|null $locale_id;
    public  $locales;
    public Page $page;

    public function mount(Page $page){
        $this->page = $page;
        $this->locales = Locale::where(["isActive" => true])->get();
        $this->title = $this->page->title??"";
        $this->code = $this->page->code??"";
        $this->content = $this->page->content??"";
        $this->isActive = $this->page->isActive??false;
        $this->locale_id = $this->page->locale_id??null;
    }
    protected function rules(){
        return (new PageUpdateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.page.edit');
    }
}
