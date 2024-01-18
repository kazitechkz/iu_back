<?php

namespace App\Http\Livewire\CareerQuizAuthor;

use App\Http\Requests\CareerQuizAuthor\CareerQuizAuthorCreate;
use App\Http\Requests\CareerQuizAuthor\CareerQuizAuthorEdit;
use App\Models\CareerQuizAuthor;
use App\Models\CareerQuizGroup;
use Livewire\Component;

class Edit extends Component
{
    public $careerQuizAuthor;
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

    public function mount(CareerQuizAuthor $careerQuizAuthor){
        $this->careerQuizAuthor = $careerQuizAuthor;
        $this->groups = CareerQuizGroup::all();
        $this->group_id = $this->careerQuizAuthor->group_id;
        $this->image_url = $this->careerQuizAuthor->image_url;
        $this->name = $this->careerQuizAuthor->name;
        $this->position_ru = $this->careerQuizAuthor->position_ru;
        $this->position_kk = $this->careerQuizAuthor->position_kk;
        $this->description_ru = $this->careerQuizAuthor->description_ru;
        $this->description_kk = $this->careerQuizAuthor->description_kk;
        $this->instagram_url = $this->careerQuizAuthor->instagram_url;
        $this->facebook_url = $this->careerQuizAuthor->facebook_url;
        $this->vk_url = $this->careerQuizAuthor->vk_url;
        $this->linkedin_url = $this->careerQuizAuthor->linkedin_url;
        $this->site = $this->careerQuizAuthor->site;
        $this->email = $this->careerQuizAuthor->email;
        $this->phone = $this->careerQuizAuthor->phone;
    }


    protected function rules(){
        return (new CareerQuizAuthorEdit())->rules();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.career-quiz-author.edit');
    }
}
