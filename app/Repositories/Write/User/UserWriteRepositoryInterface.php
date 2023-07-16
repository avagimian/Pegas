<?php

namespace App\Repositories\Write\User;

use App\Models\User;

interface UserWriteRepositoryInterface
{
    public function save(User $user): bool;
}
