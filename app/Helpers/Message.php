<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class Message
{
    public static function show(string $text, bool $status = true)
    {
        Session::put('message', [
            'text' => $text,
            'status' => $status,
        ]);
    }

    public static function get()
    {
        $message = Session::get('message');
        Session::forget('message');
        return $message;
    }
}
