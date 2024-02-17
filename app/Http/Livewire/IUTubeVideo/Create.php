<?php

namespace App\Http\Livewire\IUTubeVideo;

use App\Http\Requests\IUTubeAccess\IUTubeAccessCreateRequest;
use App\Http\Requests\IUTubeAuthor\IUTubeAuthorCreateRequest;
use App\Http\Requests\IUTubeVideo\IUTubeVideoCreateRequest;
use App\Models\IutubeAuthor;
use App\Models\Locale;
use App\Models\Step;
use App\Models\Subject;
use App\Models\SubStep;
use Livewire\Component;

class Create extends Component
{
    public $subjects;
    public $steps;
    public $sub_steps;
    public $locales;
    public $authors;

    public $title;
    public $description;
    public $image_url;
    public $author_id;
    public $locale_id;
    public $subject_id;
    public $step_id;
    public $sub_step_id;
    public $video_url;
    public $price;
    public $is_public;
    public $is_recommended;

    public function mount(){
        $this->subjects = Subject::all();
        $this->locales = Locale::all();
        $this->authors = IutubeAuthor::all();
        $this->title = old("title");
        $this->description = old("description");
        $this->author_id = old("author_id");
        $this->locale_id = old("locale_id");
        $this->subject_id = old("subject_id") ?? null;
        $this->step_id = old("step_id");
        $this->sub_step_id = old("sub_step_id");
        $this->video_url = old("video_url");
        $this->price = old("price");
        $this->is_public = old("is_public");
        $this->is_recommended = old("is_recommended");
    }

    public function updatedSubjectId(){
        if($this->subject_id){
            $this->steps = Step::where(["subject_id" => $this->subject_id])->get();
        }
        else{
            $this->steps = [];
        }
        $this->step_id = null;
        $this->sub_steps = [];
        $this->sub_step_id = null;
    }

    public function updatedStepId(){
        if($this->step_id){
            $this->sub_steps = SubStep::where(["step_id" => $this->step_id])->get();
        }
        else{
            $this->sub_steps = [];
        }
        $this->sub_step_id = null;
    }

    protected function rules(){
        return (new IUTubeVideoCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.i-u-tube-video.create');
    }
}
