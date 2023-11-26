<?php

namespace Database\Seeders;

use App\AppConstants\AppConstants;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        ini_set("memory_limit", "8192M");
//        ini_set("max_execution_time", 5000);
//        $file = File::get(storage_path('assets/sql/users.json'));
//        $users = json_decode($file);
//        if(User::count() == 0){
//            DB::table("users")->insert([
//                "name" => "Админов Админ",
//                "username" => "admin",
//                "email" => "admin@gmail.com",
//                "password" => bcrypt("admin123"),
//                "phone" => "+77777777777"
//            ]);
//            DB::table("users")->insert([
//                "name" => "Батырбек",
//                "username" => "batyr",
//                "email" => "batyr@gmail.com",
//                "password" => bcrypt("admin123"),
//                "phone" => "+777111111111"
//            ]);
//            foreach ($users as $user) {
//                User::create([
//                   'name' => $user->name,
//                   'username' => $user->name,
//                   'phone' => $user->phone,
//                   'email' => $user->email,
//                   'password' => bcrypt('123456')
//                ]);
//            }
//        }
    }
}
