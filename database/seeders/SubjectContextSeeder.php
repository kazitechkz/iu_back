<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\SubjectContext;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SubjectContextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = File::get(storage_path('assets/sql/subject_context.json'));
        $subjectContexts = json_decode($file);
        foreach ($subjectContexts as $subjectContext) {
            SubjectContext::create([
                'id' => $subjectContext->id,
                'subject_id' => $subjectContext->subject_id,
                'context' => $subjectContext->context,
                'created_at' => $subjectContext->created_at,
                'updated_at' => $subjectContext->updated_at,
                'deleted_at' => $subjectContext->deleted_at
            ]);
        }
    }
}
