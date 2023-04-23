<?php

namespace App\Services\Message;

use Illuminate\Support\Facades\Session;

class MessageHandler
{
    public function show(string $text, bool $status = true)
    {
        Session::put('message', [
            'text' => $text,
            'status' => $status,
        ]);
    }

    public function success(string $text)
    {
        $this->show($text);
    }

    public function error(string $text)
    {
        $this->show($text, false);
    }

    public static function get()
    {
        $message = Session::get('message');
        Session::forget('message');
        return $message;
    }
}
