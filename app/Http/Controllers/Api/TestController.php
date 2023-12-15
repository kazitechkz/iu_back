<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AttemptSetting;
use App\Models\Battle;
use App\Models\BattleStepResult;
use App\Models\Notification;
use App\Models\NotificationUserStatus;
use App\Services\AttemptService;
use App\Services\NotificationService;
use App\Services\QuestionService;
use App\Services\ResponseService;
use App\Services\StatisticsService;
use App\Traits\ResponseJSON;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use NotificationChannels\Telegram\TelegramMessage;

class TestController extends Controller
{
    private QuestionService $_questionService;
    private AttemptService $_attemptService;
    public function __construct(QuestionService $questionService,AttemptService $attemptService)
    {
        $this->_questionService = $questionService;
        $this->_attemptService = $attemptService;
    }



    public function test(Request $request)
    {




    }
}
