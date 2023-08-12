<?php

namespace Database\Seeders;

use App\AppConstants\AppConstants;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(DB::table("roles")->count() == 0){
            DB::table("roles")->insert([
                "name"=>AppConstants::ADMIN_NAME,
                "guard_name"=>AppConstants::ADMIN_NAME,
            ]);
            DB::table("roles")->insert([
                "name"=>AppConstants::METHOD_NAME,
                "guard_name"=>AppConstants::METHOD_NAME,
            ]);
            DB::table("roles")->insert([
                "name"=>AppConstants::TEACHER_NAME,
                "guard_name"=>AppConstants::TEACHER_NAME,
            ]);
            DB::table("roles")->insert([
                "name"=>AppConstants::STUDENT_NAME,
                "guard_name"=>AppConstants::STUDENT_NAME,
            ]);
            Log::info("Created roles");
        }

    }
}
