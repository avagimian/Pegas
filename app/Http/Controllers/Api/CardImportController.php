<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\FailImportFailedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardImportRequest;
use App\Services\CardImport\Actions\CardImportAction;
use App\Services\CardImport\Dtos\CardImportDto;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CardImportController extends Controller
{
    /**
     * @throws FailImportFailedException
     * @throws UnknownProperties
     */
    public function __invoke(
        CardImportRequest $request,
        CardImportAction $cardImportService
    ): JsonResponse {
        $dto = CardImportDto::fromRequest($request);

        $cardImportService->importFile($dto);

        return $this->success(status: ResponseAlias::HTTP_ACCEPTED);
    }
}
