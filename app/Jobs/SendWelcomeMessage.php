<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendWelcomeMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $phone;

    /**
     * Create a new job instance.
     */
    public function __construct($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $INSTANCE_ID = env('WB_INSTANCE_ID');
        $ACCESS_TOKEN = env('WB_ACCESS_TOKEN');
        Http::asForm()->post('https://biz.wapico.ru/api/send.php', [
            'number' => str_replace(' ', '', $this->phone),
            'type' => 'text',
            'message' => 'iU test - ҰБТ-ға ең жақсы онлайн дайындық платформасына қош келдіңіз 🐻!
Біздің порталда сіз 50 000-нан астам өзекті тест сұрақтарын және 16 пән бойынша 1 500 пысықталған сабақтарды таба аласыз!🔥
Бізбен бірге ҰБТ-ға дайындық, бұл:
⚡️ ойын түріндегі қадамдық оқыту;
⚡️демо нұсқада ҰБТ-ны шексіз тапсыру;
⚡️Қателіктермен жұмыс істеу мүмкіндігі;
⚡️Сіздің үлгеріміңізді талдау және статистика шығару;
⚡️Әлсіз тақырыптар бойынша тесттерді жеке таңдау;
⚡️Кәсіби оқытушылардың бейне сабақтары.
Бізде сіз оқу, турнирлерге қатысу және интеллектуалды ойындар ойнау арқылы құнды сыйлықтар ұтып ала аласыз.

Сондай-ақ, кәсіптік бағдарлау тесттерін тапсыру арқылы сіз өзіңіздің күшті жақтарыңызды анықтай аласыз💪 және армандаған мамандықты анықтай аласыз.…

Құрметпен, iU test🐻!',
            'instance_id' => $INSTANCE_ID,
            'access_token' => $ACCESS_TOKEN
        ]);
        Http::asForm()->post('https://biz.wapico.ru/api/send.php', [
            'number' => str_replace(' ', '', $this->phone),
            'type' => 'text',
            'message' => 'Добро пожаловать на лучшую онлайн-платформу по подготовке к ЕНТ - iU test🐻!
На нашем портале вы найдете более 50 000 актуальных тестовых вопросов и 1 500 проработанных уроков по 16 предметам!🔥
Подготовка к ЕНТ с нами, это:
⚡️ пошаговое обучение в игровой форме;
⚡️безлимитная сдача пробных ЕНТ в тестовом тренажере;
⚡️Возможность работы над ошибками;
⚡️Анализ и статистика вашей успеваемости;
⚡️Индивидуальный подбор тестов по слабым темам;
⚡️Видеоуроки от профессиональных репетиторов.
У нас ты можешь заработать и выиграть ценные призы проходя обучения, участвуя в турнирах и играя в интеллектуальные игры.

Также проходя профориентационные тесты ты сможешь выявить свои сильные стороны💪 и определить профессию своей мечты…

С уважением, iU test🐻!',
            'instance_id' => $INSTANCE_ID,
            'access_token' => $ACCESS_TOKEN
        ]);
    }
}
