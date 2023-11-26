<?php

namespace Database\Seeders;

use App\Models\NotificationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notification_types = [
          [
              "id"=>1,
              "value"=>"common",
              "title_ru"=>"Объявление платформы",
              "title_kk"=>"Платформа хабарландыру",
              "title_en"=>"Platform Announcement",
          ],
          [
                "id"=>2,
                "value"=>"pass-unt",
                "title_ru"=>"Задание",
                "title_kk"=>"Тапсырма",
                "title_en"=>"Task",
          ],
        ];
        foreach ($notification_types as $notification_type){
            if($notification = NotificationType::where(["id"=>$notification_type["id"]])->first()){
                if($notification->title_ru != $notification_type["title_ru"]){
                    unset($notification_type["id"]);
                    $notification->edit($notification_type);
                }
            }
            else{
                NotificationType::create($notification_type);
            }
        }
    }
}
