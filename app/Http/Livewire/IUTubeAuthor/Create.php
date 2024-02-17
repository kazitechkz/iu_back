<?php

namespace App\Http\Livewire\IUTubeAuthor;

use App\Http\Requests\IUTubeAuthor\IUTubeAuthorCreateRequest;
use Livewire\Component;

class Create extends Component
{
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

    public function mount(){
        $this->name = old("name");
        $this->description = old("description");
        $this->instagram_url = old("instagram_url");
        $this->vk_url = old("vk_url");
        $this->linkedin_url = old("linkedin_url");
        $this->facebook_url = old("facebook_url");
        $this->tiktok_url = old("tiktok_url");
        $this->phone = old("phone");
        $this->email = old("email");
        $this->is_active = old("is_active");
    }

    protected function rules(){
        return (new IUTubeAuthorCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.i-u-tube-author.create');
    }
}
