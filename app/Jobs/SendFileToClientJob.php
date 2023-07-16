<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendFileToClientJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private int $tries;
    private int $timeout;

    public function __construct(private readonly string $filePath, private readonly string $sendFileUrl)
    {
        $this->tries = 3; // set the maximum number of attempts
        $this->timeout = 30; // set the maximum time for the job
    }

    public function handle()
    {
        // send file to client, throw exception for retrying, we can set strategy for retries interval
    }

    public function failed(Throwable $exception)
    {
        // Log the error message or send a notification email
        Log::error("SendCardDataJob failed: {$exception->getMessage()}");
    }
}
