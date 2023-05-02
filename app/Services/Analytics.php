<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use CURLFile;

class Analytics
{
    public const YANDEX_PARAM = 'yaClientId';

    public function __construct(protected Option $option)
    {
    }

    public function getYandexClientId(): ?string
    {
        return session()->get(self::YANDEX_PARAM) ?? null;
    }

    public function isYandexConnect(): bool
    {
        return $this->option->get(self::YANDEX_TOKEN_OPTION) ?? false;
    }

    public function getYandexConnectLink(): string
    {
        $clientId = config('analytics.yandex.clientId');
        return "https://oauth.yandex.ru/authorize?response_type=token&client_id=$clientId";
    }

    public function saveYandexToken(string $token)
    {
        $this->option->set(self::YANDEX_TOKEN_OPTION, $token);
    }

    public function sendYandexConversion(int $price, string $yandexClientId)
    {
        $filename = 'yandexConversion.csv';
        $target = config('analytics.yandex.goal');
        $datetime = time();
        $price = number_format($price, 2, '.');
        $contents = "ClientId,Target,DateTime,Price,Currency\n";
        $contents .= sprintf("%s,%s,%s,%s,RUB", $yandexClientId, $target, $datetime, $price);
        Storage::disk('local')->put($filename, $contents);

        $counter = config('analytics.yandex.counter');
        $token = $this->option->get(self::YANDEX_TOKEN_OPTION);
        $path = Storage::disk('local')->path($filename);

        $curl = curl_init("https://api-metrika.yandex.ru/management/v1/counter/$counter/offline_conversions/upload?client_id_type=CLIENT_ID");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, array('file' => new CURLFile($path)));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data", "Authorization: OAuth $token"));
        $result = curl_exec($curl);
        curl_close($curl);

        Storage::disk('local')->delete($filename);

        var_dump($result); die();
    }


    protected const YANDEX_TOKEN_OPTION = 'yandex-analytic-token';
}
