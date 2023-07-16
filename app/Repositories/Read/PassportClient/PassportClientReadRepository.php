<?php

namespace App\Repositories\Read\PassportClient;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Passport\Client;

class PassportClientReadRepository implements PassportClientReadRepositoryInterface
{
    private function query(): Builder
    {
        return Client::query();
    }

    public function getById(string $oClientId): Client
    {
        return $this->query()
            ->where('id', $oClientId)
            ->first();
    }
}
