<?php

namespace App\Http\Livewire\LessonSchedule;

use App\Http\Requests\LessonSchedule\LessonScheduleCreateRequest;
use App\Http\Requests\LessonSchedule\LessonScheduleUpdateRequest;
use App\Models\Tutor;
use Livewire\Component;

class Edit extends Component
{
    public $tutors;
    public $lesson_schedule;
    public $tutor_id;
    public $price;
    public $amount;
    public $meeting_info;
    public $start_at;
    public $end_at;

    public function mount($lesson_schedule){
        $this->tutors = Tutor::all();
        $this->tutor_id = $lesson_schedule->tutor_id;
        $this->meeting_info = $lesson_schedule->meeting_info;
        $this->price = $lesson_schedule->price;
        $this->amount =  $lesson_schedule->amount;
        $this->start_at =  $lesson_schedule->start_at;
        $this->end_at =  $lesson_schedule->end_at;
    }
    protected function rules(){
        $rules = (new LessonScheduleUpdateRequest())->rules();
        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.lesson-schedule.edit');
    }
}
