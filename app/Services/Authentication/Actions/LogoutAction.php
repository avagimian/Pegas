<?php

namespace App\Services\Authentication\Actions;

use App\Models\User;

class LogoutAction
{
    public function run(User $user): void
    {
        $user->token()->revoke();
    }
}
