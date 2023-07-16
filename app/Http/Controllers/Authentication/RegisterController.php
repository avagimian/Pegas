<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Services\Authentication\Actions\RegisterAction;
use App\Services\Authentication\Dtos\RegisterDto;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegisterController extends Controller
{
    /**
     * @throws UnknownProperties
     */
    public function __invoke(
        RegisterRequest $request,
        RegisterAction $registerAction
    ): JsonResponse {
        $dto = RegisterDto::fromRequest($request);

        $registerAction->run($dto);

        return $this->success(status: ResponseAlias::HTTP_CREATED);
    }
}
