<?php

namespace Database\Seeders;

use App\AppConstants\AppConstants;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(User::count() == 0){
            DB::table("users")->insert([
                "name"=>"Админов Админ",
                "username"=>"admin",
                "email"=>"admin@gmail.com",
                "password"=>bcrypt("admin123"),
                "phone"=>"+77777777777"
            ]);
        }
    }
}
