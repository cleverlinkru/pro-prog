<?php

namespace App\Services\MobileConnect;

interface IMobileConnect
{
    public function sendMessage(string $phone, string $message): bool;

    public function codeCall(string $phone): ?string;

    public function getErrMsg(): string;
}
