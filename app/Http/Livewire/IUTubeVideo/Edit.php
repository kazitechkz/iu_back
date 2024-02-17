<?php

namespace App\Http\Livewire\IUTubeVideo;

use App\Http\Requests\IUTubeVideo\IUTubeVideoCreateRequest;
use App\Http\Requests\IUTubeVideo\IUTubeVideoEditRequest;
use App\Models\IutubeAuthor;
use App\Models\IutubeVideo;
use App\Models\Locale;
use App\Models\Step;
use App\Models\Subject;
use App\Models\SubStep;
use Livewire\Component;

class Edit extends Component
{
    public IutubeVideo $video;

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

    public function mount(IutubeVideo $video){
        $this->video = $video;
        $this->subjects = Subject::all();
        $this->locales = Locale::all();
        $this->authors = IutubeAuthor::all();
        $this->title = $this->video->title;
        $this->description = $this->video->description;
        $this->author_id = $this->video->author_id;
        $this->locale_id = $this->video->locale_id;
        $this->subject_id = $this->video->subject_id;

        $this->steps = Step::where(["subject_id" => $this->subject_id])->get();
        $this->step_id = $this->video->step_id;
        if($this->step_id){
            $this->sub_steps = SubStep::where(["step_id" => $this->step_id])->get();
        }
        $this->sub_step_id = $this->video->sub_step_id;
        $this->video_url = $this->video->video_url;
        $this->price = $this->video->price;
        $this->is_public = $this->video->is_public;
        $this->is_recommended = $this->video->is_recommended;
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
        return (new IUTubeVideoEditRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.i-u-tube-video.edit');
    }
}
