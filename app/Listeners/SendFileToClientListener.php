<?php

namespace App\Listeners;

use App\Events\FileProcessingCompletedEvent;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Storage;

class SendFileToClientListener
{
    public function __construct()
    {
    }

    /**
     * @throws GuzzleException
     */
    public function handle(FileProcessingCompletedEvent $event): void
    {
        $filePath = $event->filePath;
        $file = Storage::get($filePath);
        $url = $event->sendFileUrl;

        $client = new Client();
        $client->post($url, [
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => $file,
                    'filename' => basename($filePath),
                ],
            ],
        ]);
    }
}
