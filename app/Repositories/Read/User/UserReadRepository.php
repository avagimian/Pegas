<?php

namespace App\Repositories\Read\User;

use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserReadRepository implements UserReadRepositoryInterface
{
    private function query(): Builder
    {
        return User::query();
    }

    /**
     * @throws UserNotFoundException
     */
    public function getByEmail(string $email): User
    {
        $user = $this->query()
            ->where('email', $email)
            ->first();

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
