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
            'message' => 'Біздің білім беру порталына қош келдіңіз!
Біз Сіздерді оқу және даму қауымдастығымызда қарсы алуға қуаныштымыз. Мұнда сіз оқуға, білім алмасуға және дағдыларыңызды кеңейтуге көптеген мүмкіндіктер таба аласыз.
Біздің порталда сіз әртүрлі салалардағы жетекші сарапшылардың курстары, дәрістері мен материалдары арқылы оқи аласыз. Біз сіздің оқуыңыз үшін ыңғайлы және интуитивті орта құруға тырысамыз, онда сіз жаңа биіктерге жетіп, қызықты дағдыларды игере аласыз.
Сұрақтар қоюға, басқа мүшелермен сөйлесуге және өз тәжірибеңізбен бөлісуге қымсынбаңыз. Біз өзара әрекеттесу және білім алмасу табысты оқытудың негізгі құрамдас бөлігі деп санаймыз.
Тағы да қош келдіңіз және білім сапарыңызға сәттілік тілейміз!
Құрметпен,
Команда iU test!
Добро пожаловать на наш образовательный портал!
Мы рады приветствовать вас в нашем сообществе обучения и развития. Здесь вы найдете множество возможностей для обучения, обмена знаниями и расширения своих навыков.
На нашем портале вы сможете учиться с помощью курсов, лекций и материалов от ведущих экспертов в различных областях. Мы стремимся создать удобную и интуитивно понятную среду для вашего обучения, где вы сможете достигать новых высот и осваивать интересные навыки.
Не стесняйтесь задавать вопросы, общаться с другими участниками и делиться своим опытом. Мы верим, что взаимодействие и обмен знаниями - ключевые составляющие успешного обучения.
Еще раз добро пожаловать, и желаем вам удачи в вашем образовательном путешествии!
С уважением,
Команда iU test!',
            'instance_id' => $INSTANCE_ID,
            'access_token' => $ACCESS_TOKEN
        ]);
    }
}
