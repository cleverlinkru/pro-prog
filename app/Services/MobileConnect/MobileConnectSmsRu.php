<?php

namespace App\Services\MobileConnect;

class MobileConnectSmsRu implements IMobileConnect
{
    public function sendMessage(string $phone, string $message): bool
    {
        $phone =$this->preparePhone($phone);
        $ch = curl_init(self::URL_MESSAGE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'api_id' => env('SMSRU_API_ID'),
            'to' => $phone,
            'msg' => $message,
            'json' => 1,
        ]));
        $resp = json_decode(curl_exec($ch));
        curl_close($ch);

        if ($resp) {
            if ($resp->status == 'OK') {
                return true;
            } else {
                $this->errMsg = 'Ошибка: '.$resp->status_text;
                return false;
            }
        } else {
            $this->errMsg = 'Не удалось установить связь с сервисом';
            return false;
        }
    }

    public function codeCall(string $phone): ?string
    {
        $phone =$this->preparePhone($phone);
        $ch = curl_init(self::URL_CALL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'api_id' => env('SMSRU_API_ID'),
            'phone' => $phone,
        ]));
        $resp = json_decode(curl_exec($ch));
        curl_close($ch);

        if ($resp) {
            if ($resp->status == 'OK') {
                return $resp->code;
            } else {
                $this->errMsg = 'Ошибка: '.$resp->status_text;
                return null;
            }
        } else {
            $this->errMsg = 'Не удалось установить связь с сервисом';
            return null;
        }
    }

    public function getErrMsg(): string
    {
        return $this->errMsg;
    }


    protected $errMsg = '';

    protected const URL_MESSAGE = "https://sms.ru/sms/send";

    protected const URL_CALL = "https://sms.ru/code/call";


    protected function preparePhone(string $phone)
    {
        return trim(str_replace([' ', '+', '(', ')', '-'], '', $phone));
    }
}
