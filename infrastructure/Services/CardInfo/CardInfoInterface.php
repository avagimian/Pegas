<?php

namespace Infrastructure\Services\CardInfo;

use Infrastructure\Services\CardInfo\Dtos\CardInfoData;

interface CardInfoInterface
{
    public function getCardInfo(string $cardNumber): CardInfoData;
}
