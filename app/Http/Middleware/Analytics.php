<?php

namespace App\Http\Middleware;

use App\Services\Analytics as AnalyticsService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Analytics
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (request()->has(AnalyticsService::YANDEX_PARAM) && !empty(request()->input(AnalyticsService::YANDEX_PARAM))) {
            session()->put(AnalyticsService::YANDEX_PARAM, request()->input(AnalyticsService::YANDEX_PARAM));
        }

        return $next($request);
    }
}
