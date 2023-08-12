<?php

namespace Database\Seeders;

use App\AppConstants\AppConstants;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(DB::table("model_has_roles")->count() == 0){
            DB::table("model_has_roles")->insert([
                "role_id"=>1,
                "model_type"=>User::class,
                "model_id"=>1


            ]);
        }
    }
}
