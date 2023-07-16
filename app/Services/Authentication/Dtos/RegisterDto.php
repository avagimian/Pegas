<?php

namespace App\Services\Authentication\Dtos;

use App\Http\Requests\Authentication\RegisterRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class RegisterDto extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $password;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(RegisterRequest $request): RegisterDto
    {
        return new self(
            name: $request->getName(),
            email: $request->getEmail(),
            password: $request->getUserPassword()
        );
    }
}
