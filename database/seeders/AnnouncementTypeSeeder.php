<?php

namespace Database\Seeders;

use App\Models\AnnouncementType;
use App\Models\NotificationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $announcement_types = [
            [
                "id"=>1,
                "title_ru"=>"Коммерческий",
                "title_kk"=>"Коммерциялык",
                "title_en"=>"Commercial",
            ],
            [
                "id"=>2,
                "title_ru"=>"Некоммерческий",
                "title_kk"=>"Коммерциялык емес",
                "title_en"=>"Non-Commercial",
            ],
        ];
        foreach ($announcement_types as $value){
            if($announcement = AnnouncementType::where(["id"=>$value["id"]])->first()){
                if($announcement->title_ru != $announcement["title_ru"]){
                    unset($value["id"]);
                    $announcement->edit($value);
                }
            }
            else{
                AnnouncementType::create($value);
            }
        }
    }
}
