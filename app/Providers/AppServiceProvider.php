<?php

namespace App\Providers;

use App\Services\AnswerService;
use App\Services\AttemptService;
use App\Services\AuthService;
use App\Services\BattleService;
use App\Services\ClassroomService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AnswerService::class, function ($app) {
            return new AnswerService();
        });
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService();
        });
        $this->app->bind(AttemptService::class, function ($app) {
            return new AttemptService();
        });
        $this->app->bind(BattleService::class, function ($app) {
            return new BattleService();
        });
        $this->app->bind(ClassroomService::class, function ($app) {
            return new ClassroomService();
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //URL::forceScheme('https');
    }
}
