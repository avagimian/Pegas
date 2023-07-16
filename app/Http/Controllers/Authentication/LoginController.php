<?php

namespace App\Http\Controllers\Authentication;

use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Resources\Authentication\TokensResource;
use App\Services\Authentication\Actions\LoginAction;
use App\Services\Authentication\Dtos\LoginDto;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class LoginController extends Controller
{
    /**
     * @throws UserNotFoundException
     * @throws UnknownProperties
     */
    public function __invoke(
        LoginRequest $request,
        LoginAction $loginAction
    ): TokensResource {
        $dto = LoginDto::fromRequest($request);

        $result = $loginAction->run($dto);

        return new TokensResource($result);
    }
}
