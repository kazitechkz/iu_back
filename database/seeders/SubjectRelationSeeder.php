<?php

namespace Database\Seeders;

use App\Models\SubjectRelation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(SubjectRelation::all()->count() == 0){
            SubjectRelation::create([
                'subject_id' => 4,  // Математика
                'relation_id' => 5  // Физика
            ]);
            SubjectRelation::create([
                'subject_id' => 5,
                'relation_id' => 4
            ]);

            SubjectRelation::create([
                'subject_id' => 7,  // Биология
                'relation_id' => 8  // География
            ]);
            SubjectRelation::create([
                'subject_id' => 8,
                'relation_id' => 7
            ]);

            SubjectRelation::create([
                'subject_id' => 4,   // Математика
                'relation_id' => 16  // Информатика
            ]);
            SubjectRelation::create([
                'subject_id' => 16,
                'relation_id' => 4
            ]);

            SubjectRelation::create([
                'subject_id' => 9,  // Всемирная история
                'relation_id' => 8  // География
            ]);
            SubjectRelation::create([
                'subject_id' => 8,
                'relation_id' => 9
            ]);

            SubjectRelation::create([
                'subject_id' => 6,  // Химия
                'relation_id' => 7  // Биология
            ]);
            SubjectRelation::create([
                'subject_id' => 7,
                'relation_id' => 6
            ]);

            SubjectRelation::create([
                'subject_id' => 12,  // Казахский язык
                'relation_id' => 13  // Казахская литература
            ]);
            SubjectRelation::create([
                'subject_id' => 13,
                'relation_id' => 12
            ]);

            SubjectRelation::create([
                'subject_id' => 14,  // Русский язык
                'relation_id' => 15  // Русская литература
            ]);
            SubjectRelation::create([
                'subject_id' => 15,
                'relation_id' => 14
            ]);

            SubjectRelation::create([
                'subject_id' => 11,  // Иностранный язык
                'relation_id' => 9  // Всемирная история
            ]);
            SubjectRelation::create([
                'subject_id' => 9,
                'relation_id' => 11
            ]);

            SubjectRelation::create([
                'subject_id' => 4,  // Математика
                'relation_id' => 8  // География
            ]);
            SubjectRelation::create([
                'subject_id' => 8,
                'relation_id' => 4
            ]);

            SubjectRelation::create([
                'subject_id' => 9,  // Всемирная история
                'relation_id' => 10  // Основы прав
            ]);
            SubjectRelation::create([
                'subject_id' => 10,
                'relation_id' => 9
            ]);

            SubjectRelation::create([
                'subject_id' => 5,  // Физика
                'relation_id' => 6  // Химия
            ]);
            SubjectRelation::create([
                'subject_id' => 6,
                'relation_id' => 5
            ]);
        }

    }
}
