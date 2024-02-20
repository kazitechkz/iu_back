<?php

namespace App\Services;

use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\Mail;

class MailService
{
    /**
     * @param $view //наименование шаблона
     * @param $data //входной параметр
     * @param $to //почта
     * @param $title //Заголовок письма
     * @return SentMessage|null
     */
    public static function sendMail($view, $data, $to, $title)
    {
        return Mail::send($view, $data, function($message) use ($to, $title) {
            $message->to($to)->subject($title);
            $message->from('support@iutest.kz','Support iU-test');
        });
    }
}
