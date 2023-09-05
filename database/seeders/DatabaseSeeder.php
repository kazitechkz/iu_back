<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CommercialGroupPlan;
use App\Models\Question;
use App\Models\SubjectContext;
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
                PlanSeeder::class,
                SubjectSeeder::class,
                SubjectRelationSeeder::class,
                QuestionTypeSeeder::class,
                LocaleSeeder::class,
                GroupSeeder::class,
                AttemptTypeSeeder::class,
                TournamentStepSeeder::class,
                SubjectContextSeeder::class,
                QuestionsSeeder::class,
                CommercialGroupSeeder::class,
                CommercialGroupPlanSeeder::class
            ]
        );
    }
}
