<?php

namespace Database\Seeders;

use Bpuig\Subby\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //hour,day,week,month
        Plan::create([
            'tag'=>"free",
            'name'=>"Free Plan",
            'description'=>"Free Plan",
            'is_active'=>true,
            'price'=>0,
            'signup_fee'=>0,
            'currency'=>"KZT",
            'trial_period'=>0,
            'trial_interval'=>"hour",
            'trial_mode'=>"outside",
            'grace_period'=>0,
            'grace_interval'=>"hour",
            'invoice_period'=>12,
            'invoice_interval'=>"month",
        ]);
        Plan::create([
            'tag'=>"basic",
            'name'=>"Basic Plan",
            'description'=>"Basic Plan for 1 month",
            'is_active'=>true,
            'price'=>1990,
            'signup_fee'=>0,
            'currency'=>"KZT",
            'trial_period'=>0,
            'trial_interval'=>"hour",
            'trial_mode'=>"outside",
            'grace_period'=>0,
            'grace_interval'=>"hour",
            'invoice_period'=>1,
            'invoice_interval'=>"month",
        ]);
        Plan::create([
            'tag'=>"standart",
            'name'=>"Standart Plan",
            'description'=>"Standart Plan for 3 months",
            'is_active'=>true,
            'price'=>3990,
            'signup_fee'=>0,
            'currency'=>"KZT",
            'trial_period'=>0,
            'trial_interval'=>"hour",
            'trial_mode'=>"outside",
            'grace_period'=>0,
            'grace_interval'=>"hour",
            'invoice_period'=>3,
            'invoice_interval'=>"month",
        ]);
        Plan::create([
            'tag'=>"pro",
            'name'=>"Pro Plan",
            'description'=>"Pro Plan for 6 months",
            'is_active'=>true,
            'price'=>6990,
            'signup_fee'=>0,
            'currency'=>"KZT",
            'trial_period'=>0,
            'trial_interval'=>"hour",
            'trial_mode'=>"outside",
            'grace_period'=>0,
            'grace_interval'=>"hour",
            'invoice_period'=>6,
            'invoice_interval'=>"month",
        ]);
        Plan::create([
            'tag'=>"premium",
            'name'=>"Premium Plan",
            'description'=>"Premium Plan for 12 months",
            'is_active'=>true,
            'price'=>12990,
            'signup_fee'=>0,
            'currency'=>"KZT",
            'trial_period'=>0,
            'trial_interval'=>"hour",
            'trial_mode'=>"outside",
            'grace_period'=>0,
            'grace_interval'=>"hour",
            'invoice_period'=>12,
            'invoice_interval'=>"month",
        ]);
    }
}
