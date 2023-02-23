<?php

namespace App\Services\Message;

use Illuminate\Support\Facades\Facade;

class Message extends Facade
{
    protected static function getFacadeAccessor()
    {
        return MessageHandler::class;
    }
}
