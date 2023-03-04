<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Passport::tokensExpireIn(now()->addMonths());

        Passport::refreshTokensExpireIn(now()->addMonths());

        Passport::personalAccessTokensExpireIn(now()->addMonths());

        // 令牌作用域
        Passport::tokensCan([
            'basic-user-info' => '获取用户名、邮箱信息',
            'all-user-info' => '获取用户所有信息',
            'get-post-info' => '获取文章详细信息',
        ]);
    }
}
