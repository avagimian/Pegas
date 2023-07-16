<?php

namespace App\Services\Authentication\Dtos;

use App\Http\Requests\Authentication\LogoutRequest;
use App\Models\User;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class LogoutDto extends DataTransferObject
{
    public User $user;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(LogoutRequest $request): LogoutDto
    {
        return new self(
            user: $request->getAuthUser()
        );
    }
}
