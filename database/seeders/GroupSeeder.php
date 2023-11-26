<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $group_raw = [
            [
                'title_ru' => 'Платные',
                'title_kk' => 'Ақылы',
                'title_en' => 'Paid',
                'isActive' => 1,
            ],
            [
                'title_ru' => 'Бесплатные',
                'title_kk' => 'Тегін',
                'title_en' => 'Free',
                'isActive' => 1,
            ],
            [
                'title_ru' => 'Турнир',
                'title_kk' => 'Турнир',
                'title_en' => 'Tournament',
                'isActive' => 1,
            ]
        ];
        foreach ($group_raw as $value){
            if(!Group::where(["title_ru"=>$value["title_ru"]])->exists()){
                Group::create($value);
            }
        }
    }
}
