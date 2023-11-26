<?php

namespace Database\Seeders;

use App\Models\CommercialGroup;
use App\Models\CommercialGroupPlan;
use Bpuig\Subby\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommercialGroupPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(false){
            $commercials_unt = CommercialGroup::where("tag","unt")->first();
            $commercials_content = CommercialGroup::where("tag","content")->first();
            $plans_unt = Plan::whereIn("tag",["premium","pro","standart","basic","free"])->get();
            $plans_content = Plan::whereIn("tag",["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16"])->get();
            foreach ($plans_unt as $untItem){
                CommercialGroupPlan::create(["plan_id" => $untItem->id,"group_id" => $commercials_unt->id]);
            }
            foreach ($plans_content as $contentItem){
                CommercialGroupPlan::create(["plan_id" => $contentItem->id,"group_id" => $commercials_content->id]);
            }
        }
    }
}
