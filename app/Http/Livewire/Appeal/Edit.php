<?php

namespace App\Http\Livewire\Appeal;

use App\Http\Requests\Appeal\AppealCreateRequest;
use App\Http\Requests\Appeal\AppealUpdateRequest;
use App\Models\Appeal;
use App\Models\AppealType;
use App\Models\Question;
use Livewire\Component;
use Spatie\Searchable\Search;

class Edit extends Component
{
    public $question_id;
    public $search;
    public $type_id;
    public $message;
    public $status;
    public Appeal $appeal;
    public $appeal_types;
    public $questions;
    public $statuses = [
        ["id"=>-1,"name"=>"Нерешен"],
        ["id"=>0,"name"=>"Открыт"],
        ["id"=>1,"name"=>"Решен"]
    ];

    public function mount(Appeal $appeal){
        $this->appeal = $appeal;
        $this->appeal_types = AppealType::where(["isActive" => true])->get();
        $this->questions = Question::where(["id"=>$this->appeal->question_id])->get();
        $this->type_id = $this->appeal->type_id;
        $this->status = $this->appeal->status;
        $this->message = $this->appeal->message;
        $this->question_id = $this->appeal->question_id;
    }


    protected function rules(){
        return (new AppealUpdateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.appeal.edit');
    }
}
