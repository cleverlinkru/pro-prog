<?php

namespace App\Providers;

use App\Services\Analytics;
use App\Services\MobileConnect\IMobileConnect;
use App\Services\MobileConnect\MobileConnectSmsRu;
use App\Services\MobileVerify;
use App\Services\Option;
use App\Services\Payment;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Analytics::class);
        $this->app->singleton(IMobileConnect::class, MobileConnectSmsRu::class);
        $this->app->singleton(MobileVerify::class);
        $this->app->singleton(Option::class);
        $this->app->singleton(Payment::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
