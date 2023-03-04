<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        DB::listen(function ($query) {
            $data = [
                'sql' => $query->sql,
                'bingings' => $query->bindings,
                'time' => $query->time,
                'request_id' => request()->headers->get("X-Request-ID"),
            ];
            Log::info("sql exec",$data);
        });
    }
}
