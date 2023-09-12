<?php

namespace App\Http\Livewire\LessonSchedule;

use App\Http\Requests\LessonSchedule\LessonScheduleCreateRequest;
use App\Models\Tutor;
use Livewire\Component;

class Create extends Component
{

    public $tutors;
    public $tutor_id;
    public $price;
    public $amount;
    public $meeting_info;
    public $start_at;
    public $end_at;

    public function mount(){
        $this->tutors = Tutor::all();
        $this->tutor_id = old("tutor_id");
        $this->meeting_info = old("meeting_info")??"";
        $this->price = old("price") ?? 0;
        $this->amount = old("amount") ?? 0;
        $this->start_at = old("start_at") ?? null;
        $this->end_at = old("end_at") ?? null;
    }
    protected function rules(){
        $rules = (new LessonScheduleCreateRequest())->rules();
        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view('livewire.lesson-schedule.create');
    }
}
