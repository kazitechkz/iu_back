<?php

namespace App\Http\Livewire\CareerQuizCoupons;

use App\Http\Requests\CareerQuizCoupon\CareerQuizCouponCreate;
use App\Http\Requests\CareerQuizCoupon\CareerQuizCouponEdit;
use App\Models\CareerCoupon;
use App\Models\CareerQuiz;
use App\Models\CareerQuizGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Edit extends Component
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
    public $careerCoupon;


    public function mount(CareerCoupon $careerCoupon){
        $this->careerCoupon = $careerCoupon;
        $this->career_groups = CareerQuizGroup::where(["id"=>$careerCoupon->career_group_id])->get();

        $this->user_id = $careerCoupon->user_id;
        $this->order_id = $careerCoupon->order_id;
        $this->career_group_id = $careerCoupon->career_group_id;
        $this->career_quiz_id = $careerCoupon->career_quiz_id;
        if($this->user_id){
            $this->users = User::where(["id"=>$this->user_id])->get();
        }
        if($this->career_quiz_id){
            $this->career_quizzes = CareerQuiz::where(["id"=>$this->career_quiz_id])->get();
        }
        $this->status = $careerCoupon->status;
        $this->is_used = $careerCoupon->is_used;
    }

    protected function rules(){
        return (new CareerQuizCouponEdit())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.career-quiz-coupons.edit');
    }
}
