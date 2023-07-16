<?php

namespace App\Traits\User;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

trait GetAuthUserTraits
{
    public function getAuthUser(): ?Authenticatable
    {
        return Auth::user();
    }
}
