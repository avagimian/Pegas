<?php

namespace App\Repositories\Read\PassportClient;

use Laravel\Passport\Client;

interface PassportClientReadRepositoryInterface
{
    public function getById(string $oClientId): Client;
}
