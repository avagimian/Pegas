<?php

namespace App\Http\Requests\Authentication;

use App\Traits\User\GetAuthUserTraits;
use Illuminate\Foundation\Http\FormRequest;

class LogoutRequest extends FormRequest
{
    use GetAuthUserTraits;

    public function rules(): array
    {
        return [
            //
        ];
    }
}
