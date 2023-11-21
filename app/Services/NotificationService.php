<?php

namespace App\Services;

use App\Models\AttemptSetting;
use App\Models\AttemptSettingsUnt;
use App\Models\Notification;

class NotificationService
{
    public const TASK_TYPE_ID = 2;
    public const FRONT_URL = "/dashboard/pass-unt-by-promo/";
    public static function createNotification(AttemptSetting $setting){
        $promo_code_link = self::FRONT_URL . $setting->promo_code;
        $title = "Cізге {$setting->owner->name} тапсырма жіберді! {$setting->owner->name} отправил Вам задание!";
        $message = "<h3><strong>Уважаемый пользователь, Вам  отправили  задание!</strong></h3><p><em>Уважаемый пользователь Вам необходимо пройти по следующей ссылке, для прохождения тестирования </em> <em>(<a href='$promo_code_link'>кликните сюда</a>), или введите промокод - {$setting->promo_code}</em></p><h3><strong>Құрметті пайдаланушы, сізге тапсырма жіберілді!</strong></h3><p><em>Құрметті пайдаланушы Сіз тестілеуден өту үшін келесі сілтемеден өтуіңіз керек <a href='$promo_code_link'>(мында басыңыз)</a> немесе жарнамалық кодты енгізіңіз- {$setting->promo_code}</em></p>";
        Notification::add(["type_id"=>self::TASK_TYPE_ID,"title"=>$title,"message"=>$message,"users"=>$setting->users,"owner_id"=>$setting->owner_id,"class_id"=>$setting->class_id]);
    }


    public static function createUNTNotification(AttemptSettingsUnt $setting){
        $promo_code_link = self::FRONT_URL . $setting->promo_code;
        $title = "Cізге {$setting->sender->name} тапсырма жіберді! {$setting->sender->name} отправил Вам задание!";
        $message = "<h3><strong>Уважаемый пользователь, Вам  отправили  задание!</strong></h3><p><em>Уважаемый пользователь Вам необходимо пройти по следующей ссылке, для прохождения тестирования </em> <em>(<a href='$promo_code_link'>кликните сюда</a>), или введите промокод - {$setting->promo_code}</em></p><h3><strong>Құрметті пайдаланушы, сізге тапсырма жіберілді!</strong></h3><p><em>Құрметті пайдаланушы Сіз тестілеуден өту үшін келесі сілтемеден өтуіңіз керек <a href='$promo_code_link'>(мында басыңыз)</a> немесе жарнамалық кодты енгізіңіз- {$setting->promo_code}</em></p>";
        Notification::add(["type_id"=>self::TASK_TYPE_ID,"title"=>$title,"message"=>$message,"users"=>$setting->users,"owner_id"=>$setting->sender_id,"class_id"=>$setting->class_id]);
    }


}
