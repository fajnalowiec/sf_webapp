<?php

namespace App\Service\ShippingPrice;

use App\MoreleEntity\Order;

/*
 * realize rule:
 * - Do 5 kg włącznie: brak dopłaty
 * - Powyżej 5 kg: +3 PLN za każdy “rozpoczęty” kilogram
 */
class WeightShippingRule implements ShippingPriceRuleInterface
{

    public function calcPrice(Order $order, int $currentPrice): int
    {
        $weight = $order->getTotalWeight() - 5;
        if ($weight > 0) {
            $currentPrice += 300 * ceil($weight);
        }
        return $currentPrice;
    }

}