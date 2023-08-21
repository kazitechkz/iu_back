<?php

namespace App\Http\Livewire\Group;

use App\Http\Requests\Group\GroupCreateRequest;
use App\Models\Group;
use App\Models\GroupPlan;
use Bpuig\Subby\Models\Plan;
use Livewire\Component;

class Edit extends Component
{
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $isActive;
    public $plans;
    public $planGroups;
    public Group $group;

    public function mount(Group $group){
        $this->group = $group;
        $this->plans = Plan::all();
        $this->title_ru = $this->group->title_ru ?? "";
        $this->title_kk = $this->group->title_kk ?? "";
        $this->title_en = $this->group->title_en ?? "";
        $this->isActive = $this->group->isActive ?? true;
        $this->planGroups = array_values($this->group->plans()->get()->pluck("id")->toArray());
    }
    protected function rules(){
        return (new GroupCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function changePlan($id){
        $group_plan = GroupPlan::where(["plan_id"=>$id,"group_id"=>$this->group->id])->first();
        if($group_plan != null){
                $group_plan->delete();
                toastr()->info("Removed from plan");
        }
        else{
            if($group_plan == null){
                GroupPlan::add(["group_id"=>$this->group->id,"plan_id"=>$id]);
                toastr()->info("Added to plan");
            }
        }
        $this->planGroups = array_values($this->group->plans()->get()->pluck("id")->toArray());

    }
    public function render()
    {
        return view('livewire.group.edit');
    }
}
