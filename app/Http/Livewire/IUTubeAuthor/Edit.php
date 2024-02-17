<?php

namespace App\Http\Livewire\IUTubeAuthor;

use App\Http\Requests\IUTubeAuthor\IUTubeAuthorEditRequest;
use App\Models\IutubeAuthor;
use Livewire\Component;

class Edit extends Component
{
    public $author;
    public $image_url;
    public $name;
    public $description;
    public $instagram_url;
    public $vk_url;
    public $linkedin_url;
    public $facebook_url;
    public $tiktok_url;
    public $phone;
    public $email;
    public $is_active;

    public function mount(IutubeAuthor $author){
        $this->author = $author;
        $this->name = $this->author->name;
        $this->description = $this->author->description;
        $this->instagram_url = $this->author->instagram_url;
        $this->vk_url = $this->author->vk_url;
        $this->linkedin_url = $this->author->linkedin_url;
        $this->facebook_url = $this->author->facebook_url;
        $this->tiktok_url = $this->author->tiktok_url;
        $this->phone = $this->author->phone;
        $this->email = $this->author->email;
        $this->is_active = $this->author->is_active;
    }

    protected function rules(){
        return (new IUTubeAuthorEditRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }



    public function render()
    {
        return view('livewire.i-u-tube-author.edit');
    }
}
