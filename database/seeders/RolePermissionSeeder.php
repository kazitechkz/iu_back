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
            $permissions = Permission::all();
            foreach ($permissions as $permission) {
                if(!DB::table("role_has_permissions")->where(["permission_id" => $permission->id, "role_id" => 1])->exists()){
                    DB::table("role_has_permissions")->insert([
                        "permission_id" => $permission->id,
                        "role_id" => 1
                    ]);
                }
                if (in_array($permission->name, AppConstants::METHOD_PERMISSIONS)) {
                    if(!DB::table("role_has_permissions")->where(["permission_id" => $permission->id, "role_id" => 2])->exists()){
                        DB::table("role_has_permissions")->insert([
                            "permission_id" => $permission->id,
                            "role_id" => 2
                        ]);
                    }
                }
            }

    }
}
