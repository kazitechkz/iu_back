<?php

namespace Database\Seeders;

use App\Models\Locale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Locale::create([
           'code' => 'kk',
           'title' => 'Қазақ тілі',
           'isActive' => 0
        ]);
        Locale::create([
            'code' => 'ru',
            'title' => 'Русский язык',
            'isActive' => 1
        ]);
    }
}
