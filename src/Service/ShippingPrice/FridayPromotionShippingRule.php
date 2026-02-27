<?php

namespace App\Service\ShippingPrice;

use App\MoreleEntity\CountryShipping;
use App\MoreleEntity\Order;

/*
 * realize rule:
 * - W każdy piątek koszt dostawy obniżony o 50%
 * - Nie stosuje się, jeśli dostawa jest już darmowa
 * - Łączy się z obniżką dla USA (najpierw rabat USA, potem rabat piątkowy)
 */
class FridayPromotionShippingRule implements ShippingPriceRuleInterface
{

    public function calcPrice(Order $order, int $currentPrice): int
    {
        if (0 === $currentPrice) {
            return 0;
        }
        
        if ((int) date('N', $order->getTimestamp()) === 5) {
            $currentPrice = intdiv($currentPrice, 2);
        }
        return $currentPrice;
    }

}