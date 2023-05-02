<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnalyticTokenRequest;
use App\Services\Analytics;
use Inertia\Inertia;

class AnalyticsController extends Controller
{
    public function __construct(protected Analytics $analytics)
    {
    }

    public function settings()
    {
        return Inertia::render('Analytics/Settings', [
            'isYandexConnect' => $this->analytics->isYandexConnect(),
            'yandexConnectLink' => $this->analytics->getYandexConnectLink(),
        ]);
    }

    public function yandexConnect()
    {
        return Inertia::render('Analytics/YandexConnect');
    }

    public function saveYandexToken(AnalyticTokenRequest $request)
    {
        $this->analytics->saveYandexToken($request->token);

        return response()->json(['success' => true]);
    }
}
