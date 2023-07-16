<?php

namespace App\Jobs;

use App\Events\FileProcessingCompletedEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Maatwebsite\Excel\Facades\Excel;

class StartCardDataFillingJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(protected string $filePath, protected string $sendFileUrl)
    {
    }

    public function handle()
    {
        $filePath = $this->filePath;
        $data = Excel::toArray((object)[], $filePath)[0];
        $cardData = array_map(
            fn($subArray) => array_filter(
                $subArray,
                fn($value) => $value !== null
            ),
            $data
        );

        $cardNumberIndex = array_search('card_number', $cardData[0]);
        $jobs = [];

        for ($row = 1; $row <= count($cardData) - 1; $row++) {
            $jobs[] = new GenerateCardInfoJob(
                $row,
                $cardData[$row][$cardNumberIndex],
                $filePath
            );
        }

        Bus::batch($jobs)->then(function () use ($filePath) {
            FileProcessingCompletedEvent::dispatch($filePath, $this->sendFileUrl);
        })->dispatch();
    }
}
