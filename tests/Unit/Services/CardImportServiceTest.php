<?php

namespace Tests\Unit\Services;

use App\Events\CardDataUploadedEvent;
use App\Exceptions\FailImportFailedException;
use App\Jobs\StartCardDataFillingJob;
use App\Services\CardImport\Actions\CardImportAction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CardImportServiceTest extends TestCase
{
    /**
     * @throws FailImportFailedException
     */
    public function test_it_can_import_a_valid_file()
    {
        Storage::fake();
        $faker = \Faker\Factory::create();

        $file = UploadedFile::fake()->create('cards.xlsx', 100);
        $service = new CardImportAction();

        $job = new StartCardDataFillingJob($file->getPath(), $faker->url());
        Bus::fake();
        Bus::dispatch($job);
        Bus::assertDispatched(StartCardDataFillingJob::class);

        Event::fake([CardDataUploadedEvent::class]);

        $service->importFile($file, $faker->url());

        Event::assertDispatched(CardDataUploadedEvent::class);
    }

    public function test_it_throws_exception_if_import_failed()
    {
        Storage::shouldReceive('putFile')->andReturn(false);

        $file = UploadedFile::fake()->create('cards.xlsx', 100);
        $service = new CardImportAction();

        $this->expectException(FailImportFailedException::class);

        $service->importFile($file, 'https://example.com');
    }
}
