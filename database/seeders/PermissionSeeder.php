<?php

namespace Database\Seeders;

use App\AppConstants\AppConstants;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(DB::table("permissions")->count() == 0){
            foreach (AppConstants::ADMIN_PERMISSIONS as $PERMISSION){
                DB::table("permissions")->insert([
                    "name"=>$PERMISSION,
                    "guard_name"=>"web",
                ]);
            }
            Log::info("Created permissions");
        }
    }
}
