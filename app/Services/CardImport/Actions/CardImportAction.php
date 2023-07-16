<?php

namespace App\Services\CardImport\Actions;

use App\Events\CardDataUploadedEvent;
use App\Exceptions\FailImportFailedException;
use App\Services\CardImport\Dtos\CardImportDto;
use Illuminate\Support\Facades\Storage;

class CardImportAction
{
    /**
     * @throws FailImportFailedException
     */
    public function importFile(CardImportDto $dto): void
    {
        $path = Storage::putFile('uploads', $dto->file);

        if (!$path) {
            throw new FailImportFailedException();
        }

        CardDataUploadedEvent::dispatch($path, $dto->sendFileUrl);
    }
}
