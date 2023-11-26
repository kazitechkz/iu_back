<?php

namespace Database\Seeders;

use App\Models\TechSupportCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechSupportCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tech_support_type_raw = [
            [
                "id"=>1,
                "title_ru"=>"Технический отдел",
                "title_kk"=>"Техникалық бөлім",
                "title_en"=>"Technical Department",
            ],
            [
                "id"=>2,
                "title_ru"=>"Финансовая отдел",
                "title_kk"=>"Қаржылық бөлім",
                "title_en"=>"Financial Department",
            ],
            [
                "id"=>3,
                "title_ru"=>"Отдел менеджемента",
                "title_kk"=>"Менеджемент бөлімі",
                "title_en"=>"Management Department",
            ],
            [
                "id"=>4,
                "title_ru"=>"Отдел управления",
                "title_kk"=>"Басқару бөлімі",
                "title_en"=>"Head Department",
            ],
        ];
        foreach ($tech_support_type_raw as $tech_supports){
            if($type = TechSupportCategory::where(["id"=>$tech_supports["id"]])->first()){
                if($type->title_ru != $tech_supports["title_ru"]){
                    unset($tech_supports["id"]);
                    $type->edit($tech_supports);
                }
            }
            else{
                TechSupportCategory::create($tech_supports);
            }

        }
    }
}
