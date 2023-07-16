<?php

namespace Infrastructure\Services\CardInfo\Dtos;

use Spatie\LaravelData\Data;

class CardInfoData extends Data
{
    public function __construct(
        public string $scheme,
        public string $type,
        public string $bankName
    ) {
    }
}
