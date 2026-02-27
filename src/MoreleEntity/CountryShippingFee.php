<?php

namespace App\MoreleEntity;

/*
 * you probably gonna get these values from DB in the final version and it is
 * gonna be a collection of CountryFee doctrine entity. I use here just an
 * association table. Not great, not terrible.
 */

class CountryShippingFee
{
    public const DEFAULT_COUNTRY = 'XX';
    public const US_COUNTRY = 'US';
    private array $countryFees = [
        'PL' => 1000,
        'DE' => 2000,
        'US' => 5000,
        'XX' => 3999,
    ];

    public function getFees(): array
    {
        return $this->countryFees;
    }
}

