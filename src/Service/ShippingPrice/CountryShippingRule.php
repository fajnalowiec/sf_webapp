<?php

namespace App\Service\ShippingPrice;

use App\MoreleEntity\CountryShippingFee;
use App\MoreleEntity\Order;

/*
 * realize rule:
 * Polska -> 10 PLN
 * Niemcy -> 20 PLN
 * USA -> 50 PLN
 * Pozostałe kraje -> 39.99 PLN
 */
class CountryShippingRule implements ShippingPriceRuleInterface
{
    private CountryShippingFee $countryShippingFee;
    
    public function __construct(CountryShippingFee $countryShippingFee) {
        $this->countryShippingFee = $countryShippingFee;
    }

    public function calcPrice(Order $order, int $currentPrice): int
    {
        $country = $order->getDestinationCountry();
        if (!array_key_exists($country, $this->countryShippingFee->getFees())) {
           $country = $this->countryShippingFee::DEFAULT_COUNTRY;
        }
        $currentPrice += $this->countryShippingFee->getFees()[$country];
        return $currentPrice;
    }

}