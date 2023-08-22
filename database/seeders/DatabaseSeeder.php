<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            [
                RoleSeeder::class,
                PermissionSeeder::class,
                RolePermissionSeeder::class,
                UserSeeder::class,
                UserRoleSeeder::class,
                SubjectSeeder::class,
                QuestionTypeSeeder::class,
                LocaleSeeder::class,
                GroupSeeder::class
            ]
        );
    }
}
