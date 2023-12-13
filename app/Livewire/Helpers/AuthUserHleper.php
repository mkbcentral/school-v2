<?php

namespace App\Livewire\Helpers;

use Illuminate\Support\Facades\Auth;

class AuthUserHleper
{
    public static function login(array $data): bool
    {
        return Auth::attempt($data);
    }
}
