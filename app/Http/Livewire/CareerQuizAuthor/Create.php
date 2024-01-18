<?php

namespace App\Http\Livewire\CareerQuizAuthor;

use App\Http\Requests\CareerQuizAuthor\CareerQuizAuthorCreate;
use App\Http\Requests\CareerQuizGroup\CareerQuizGroupCreate;
use App\Models\CareerQuizGroup;
use Livewire\Component;

class Create extends Component
{
    public $groups;
    public $group_id;
    public $image_url;
    public $name;
    public $position_ru;
    public $position_kk;
    public $description_ru;
    public $description_kk;
    public $instagram_url;
    public $facebook_url;
    public $vk_url;
    public $linkedin_url;
    public $site;
    public $email;
    public $phone;

    public function mount(){
        $this->groups = CareerQuizGroup::all();
        $this->group_id = old("group_id") ?? null;
        $this->image_url = old("image_url") ?? null;
        $this->name = old("name");
        $this->position_ru = old("position_ru");
        $this->position_kk = old("position_kk");
        $this->description_ru = old("description_ru");
        $this->description_kk = old("description_kk");
        $this->instagram_url = old("instagram_url");
        $this->facebook_url = old("facebook_url");
        $this->vk_url = old("vk_url");
        $this->linkedin_url = old("linkedin_url");
        $this->site = old("site");
        $this->email = old("email");
        $this->phone = old("phone");
    }


    protected function rules(){
        return (new CareerQuizAuthorCreate())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.career-quiz-author.create');
    }
}
