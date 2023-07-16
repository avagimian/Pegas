<?php

namespace App\Providers;

use App\Repositories\Read\PassportClient\PassportClientReadRepository;
use App\Repositories\Read\PassportClient\PassportClientReadRepositoryInterface;
use App\Repositories\Read\User\UserReadRepository;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Repositories\Write\User\UserWriteRepository;
use App\Repositories\Write\User\UserWriteRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Services\CardInfo\BinListClient;
use Infrastructure\Services\CardInfo\CardInfoInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            CardInfoInterface::class,
            BinListClient::class
        );

        $this->app->bind(
            UserWriteRepositoryInterface::class,
            UserWriteRepository::class
        );

        $this->app->bind(
            UserReadRepositoryInterface::class,
            UserReadRepository::class
        );

        $this->app->bind(
            PassportClientReadRepositoryInterface::class,
            PassportClientReadRepository::class
        );
    }
}
