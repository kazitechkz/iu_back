<?php

namespace App\Http\Livewire\Appeal;

use App\Http\Requests\Appeal\AppealCreateRequest;
use App\Models\AppealType;
use App\Models\Question;
use Livewire\Component;
use Spatie\Searchable\Search;

class Create extends Component
{
    public $question_id;
    public $search;
    public $type_id;
    public $message;
    public $status;
    public $appeal_types;
    public $questions;
    public $statuses = [
        ["id"=>-1,"name"=>"Нерешен"],
        ["id"=>0,"name"=>"Открыт"],
        ["id"=>1,"name"=>"Решен"]
    ];

    public function mount(){
        $this->appeal_types = AppealType::where(["isActive" => true])->get();
        $this->type_id = old("type_id")??0;
        $this->status = old("status")??0;
        $this->message = old("message")??"";
        $this->question_id = old("question_id")??0;
    }



    protected function searchQuestions(){

        if(strlen($this->search)){
            $this->questions = (new Search())
                ->registerModel(Question::class, ['text', 'context'])
                ->search($this->search);
        }
    }

    protected function rules(){
        return (new AppealCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $this->searchQuestions();
        return view('livewire.appeal.create');
    }
}
