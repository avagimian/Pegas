<?php

namespace App\Repositories\Write\User;

use App\Exceptions\SavingErrorException;
use App\Models\User;

class UserWriteRepository implements UserWriteRepositoryInterface
{
    /**
     * @throws SavingErrorException
     */
    public function save(User $user): bool
    {
        if (!$user->save()) {
            throw new SavingErrorException();
        }

        return true;
    }
}
