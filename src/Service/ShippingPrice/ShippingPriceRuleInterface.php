<?php

namespace App\Service\ShippingPrice;

use App\MoreleEntity\Order;

interface ShippingPriceRuleInterface
{
    public function calcPrice(Order $order, int $currentPrice): int;
}