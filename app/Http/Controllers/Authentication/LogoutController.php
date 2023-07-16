<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LogoutRequest;
use App\Services\Authentication\Actions\LogoutAction;
use App\Services\Authentication\Dtos\LogoutDto;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LogoutController extends Controller
{
    /**
     * @throws UnknownProperties
     */
    public function __invoke(
        LogoutRequest $request,
        LogoutAction $logoutAction
    ): JsonResponse {
        $dto = LogoutDto::fromRequest($request);

        $logoutAction->run($dto->user);

        return $this->success(status: ResponseAlias::HTTP_OK);
    }
}
