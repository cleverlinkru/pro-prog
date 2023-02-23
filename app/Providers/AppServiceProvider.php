<?php

namespace App\Providers;

use App\Services\MobileConnect\IMobileConnect;
use App\Services\MobileConnect\MobileConnectSmsRu;
use App\Services\MobileVerify;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(MobileVerify::class);
        $this->app->singleton(IMobileConnect::class, MobileConnectSmsRu::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
