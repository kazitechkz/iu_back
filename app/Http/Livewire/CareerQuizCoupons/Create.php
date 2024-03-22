<?php

namespace App\Http\Livewire\CareerQuizCoupons;

use App\Http\Requests\CareerQuizAnswer\CareerQuizAnswerCreate;
use App\Http\Requests\CareerQuizCoupon\CareerQuizCouponCreate;
use App\Models\CareerQuiz;
use App\Models\CareerQuizGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Create extends Component
{
    public $users;
    public $user_search;
    public  $user_id;
    public $order_id;
    public $career_quiz_id;
    public $career_quizzes;
    public $career_group_id;
    public $career_groups;
    public $is_used;
    public $status;

    public function findUser()
    {
        if($this->user_search){
            $search = $this->user_search;
         $this->users = User::where(function (Builder $query) use ($search) {
             $query->where("name","LIKE","%".$search."%")->orWhere("email","LIKE","%".$search."%");
         })->take(20)->get();
         toastr()->success("Найдено совпадений:" .$this->users->count());
        }
    }

    public function mount(){
        $this->career_groups = CareerQuizGroup::all();
        $this->user_id = old("user_id");
        $this->order_id = old("order_id");
        $this->career_group_id = old("career_group_id");
        if($this->career_group_id){
            $this->career_quizzes = CareerQuiz::where(["group_id" => $this->career_group_id])->get();
            $this->career_quiz_id = old("career_quiz_id");
        }
        if($this->user_id){
            $this->users = User::where(["id"=>$this->user_id])->get();
        }
        $this->status = old("status");
        $this->is_used = old("is_used");

    }

    protected function rules(){
        return (new CareerQuizCouponCreate())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedCareerGroupId()
    {
        if($this->career_group_id){
            $this->career_quizzes = CareerQuiz::where(["group_id" => $this->career_group_id])->get();
        }
        else{
            $this->career_quizzes = null;
        }
        $this->career_quiz_id = null;
    }

    public function render()
    {
        return view('livewire.career-quiz-coupons.create');
    }
}
