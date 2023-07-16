<?php

namespace App\Exceptions;

class UserNotFoundException extends BusinessLogicException
{
    public function getStatus(): int
    {
        return BusinessLogicException::USER_NOT_FOUND;
    }

    public function getStatusMessage(): string
    {
        return __('errors.user_not_found');
    }
}
