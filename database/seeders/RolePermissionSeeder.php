<?php

namespace Database\Seeders;

use App\AppConstants\AppConstants;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(DB::table("role_has_permissions")->count() == 0){
            $permissions = Permission::all();
            foreach ($permissions as $permission){
               DB::table("role_has_permissions")->insert([
                  "permission_id"=>$permission->id,
                   "role_id"=>1
               ]);
            }


        }
    }
}
