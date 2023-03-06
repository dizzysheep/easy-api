<?php

namespace App\Providers;

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->ListenSql();
    }

    /**
     * @desc 监听sql
     * @return void
     */
    protected function ListenSql()
    {
        DB::listen(function ($query) {
            $data = [
                'sql' => $query->sql,
                'bingings' => $query->bindings,
                'time' => $query->time,
                'request_id' => request()->headers->get("X-Request-ID"),
            ];

            $this->sendExceptionMail($data["time"]);

            Log::info("sql exec", $data);
        });
    }

    /**
     * @desc 慢sql发送邮件
     * @param $time
     * @return void
     */
    protected function sendExceptionMail($time)
    {
        if ($time <= 1000) {
            return;
        }
        Mail::raw('laravel slow sql', function (Message $message) {
            // 邮件接收者
            $message->to(env('TEST_MAIL_USERNAME'));
            // 邮件主题
            $message->subject('大笨蛋，收到没！！！');
        });
    }
}
