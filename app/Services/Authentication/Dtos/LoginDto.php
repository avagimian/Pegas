<?php

namespace App\Services\Authentication\Dtos;

use App\Http\Requests\Authentication\LoginRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class LoginDto extends DataTransferObject
{
    public string $email;
    public string $password;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(LoginRequest $request): LoginDto
    {
        return new self(
            email: $request->getEmail(),
            password: $request->getUserPassword()
        );
    }
}
