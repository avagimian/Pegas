<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Infrastructure\Services\CardInfo\CardInfoInterface;
use Infrastructure\Services\CardInfo\Dtos\CardInfoData;

class GenerateCardInfoJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private CardInfoData $cardData;

    public function __construct(
        public int $row,
        public string $cardNumber,
        public string $filePath
    ) {
    }

    public function handle(CardInfoInterface $cardInfoInterface)
    {
        $this->initCartData($cardInfoInterface);
        $this->updateInFile();
    }

    private function initCartData(CardInfoInterface $cardInfoService)
    {
        $this->cardData = $cardInfoService->getCardInfo($this->cardNumber);
    }

    private function updateInFile()
    {
        //If the file is already locked by another process, the fopen function will block and wait for the lock to be released before it can open the file.
        $handle = fopen(Storage::path($this->filePath), 'r');

        if (flock($handle, LOCK_SH)) {
            $contents = fread($handle, filesize(Storage::path($this->filePath)));

            // Here we make all the necessary changes in the file
            $this->cardData;

            flock($handle, LOCK_UN);
        }

        fclose($handle);
    }
}
