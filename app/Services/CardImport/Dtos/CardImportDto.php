<?php

namespace App\Services\CardImport\Dtos;

use App\Http\Requests\CardImportRequest;
use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CardImportDto extends DataTransferObject
{
    public UploadedFile $file;
    public string $sendFileUrl;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(CardImportRequest $request): CardImportDto
    {
        return new self(
            file: $request->getFile(),
            sendFileUrl: $request->getUrlToFileSending()
        );
    }
}
