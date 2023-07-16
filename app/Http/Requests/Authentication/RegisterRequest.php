<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    const NAME = 'name';
    const EMAIL = 'email';
    const PASSWORD = 'password';

    public function rules(): array
    {
        return [
            self::NAME => [
                'required',
                'string',
            ],

            self::EMAIL => [
                'required',
                'string',
            ],

            self::PASSWORD => [
                'required',
                'string',
                'min:4',
                'confirmed',
            ],
        ];
    }

    public function getName(): string
    {
        return $this->get(self::NAME);
    }

    public function getEmail(): string
    {
        return $this->get(self::EMAIL);
    }

    public function getUserPassword(): string
    {
        return $this->get(self::PASSWORD);
    }
}
