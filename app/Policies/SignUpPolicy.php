<?php

namespace App\Policies;

use App\Models\User;

class SignUpPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function check()
    {
        return config('auth.on_sign_up');
    }
}
