<?php

namespace App\Repositories\Read\User;

use App\Models\User;

interface UserReadRepositoryInterface
{
    public function getByEmail(string $email): User;
}
