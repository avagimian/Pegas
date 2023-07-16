<?php

namespace App\Listeners;

use App\Events\CardDataUploadedEvent;
use App\Jobs\StartCardDataFillingJob;

class FillCardInfoListener
{
    public function __construct()
    {
    }

    public function handle(CardDataUploadedEvent $event): void
    {
        StartCardDataFillingJob::dispatch($event->filePath, $event->sendFileUrl);
    }
}
