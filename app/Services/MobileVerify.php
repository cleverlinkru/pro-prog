<?php

namespace App\Services;

use App\Services\MobileConnect\IMobileConnect;

class MobileVerify
{
    public function __construct(protected IMobileConnect $mobileConnect)
    {
    }

    public function sendCode(string $phone): bool
    {
        $code = $this->generateCode();
        $message = "Код для подтверждения номера телефона: $code";

        $res = $this->mobileConnect->sendMessage($phone, $message);

        if ($res) {
            session()->put(self::SES_PHONE, $phone);
            session()->put(self::SES_CODE, $code);
        } else {
            $this->errMsg = $this->mobileConnect->getErrMsg();
        }

        return $res;
    }

    public function callCode(string $phone): bool
    {
        $res = $this->mobileConnect->codeCall($phone);

        if ($res !== null) {
            session()->put(self::SES_PHONE, $phone);
            session()->put(self::SES_CODE, $res);
            return true;
        } else {
            $this->errMsg = $this->mobileConnect->getErrMsg();
            return false;
        }
    }

    public function checkCode(string $phone, string $code): bool
    {
        $sesPhone = session()->get(self::SES_PHONE);
        if (!$sesPhone || $sesPhone != $phone) {
            $this->errMsg = 'Неверный номер телефона';
            return false;
        }

        $sesCode = session()->get(self::SES_CODE);
        if (!$sesCode || $sesCode != $code) {
            $this->errMsg = 'Неверный код';
            return false;
        }

        return true;
    }

    public function getErrMsg(): string
    {
        return $this->errMsg;
    }


    protected const SES_PHONE = 'MobileVerifyPhone';

    protected const SES_CODE = 'MobileVerifyCode';

    protected const CODE_LEN = 4;

    protected $errMsg = '';

    protected function generateCode()
    {
        $code = '';
        for ($i = 1; $i <= self::CODE_LEN; $i++) {
            $code .= rand(0, 9);
        }
        return $code;
    }
}
