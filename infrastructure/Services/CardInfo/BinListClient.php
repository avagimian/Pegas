<?php

namespace Infrastructure\Services\CardInfo;

use Infrastructure\Services\CardInfo\Dtos\CardInfoData;

class BinListClient implements CardInfoInterface
{
    public function getCardInfo(string $cardNumber): CardInfoData
    {
        // make request to client, throw exception about failed with reason or return CardInfoData
        $scheme = 'debit';
        $type = 'visa';
        $bankName = 'sberbank';

        return new CardInfoData(
            $scheme,
            $type,
            $bankName
        );
    }
}
