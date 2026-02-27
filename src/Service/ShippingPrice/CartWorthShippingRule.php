<?php

namespace App\Service\ShippingPrice;

use App\MoreleEntity\Order;
use App\MoreleEntity\CountryShippingFee;

/*
 * realize rule:
 * - Wartość koszyka ≥ 400 PLN → dostawa darmowa
 * - Wyjątek dla USA: zamiast darmowej dostawy — obniżka 50%
 *
 */
class CartWorthShippingRule implements ShippingPriceRuleInterface
{

    public function calcPrice(Order $order, int $currentPrice): int
    {
        $totalPrice = $order->getTotalPrice();
        if ($totalPrice >= 40000) {
            if ($order->getDestinationCountry() === CountryShippingFee::US_COUNTRY) {
                $currentPrice = intdiv($currentPrice, 2);
            } else {
                $currentPrice = 0;
            }
        }
        return $currentPrice;
    }

}