<?php

namespace App\Service\ShippingPrice;

use App\MoreleEntity\Order;

class ShippingPriceCalculator
{
    /**
     * @var App\Service\ShippingPriceRuleInterface[] $rules
     */
    private array $rules = [];
    private Order $order;

    public function __construct(Order $order, array $rules)
    {
        $this->order = $order;
        $this->rules = $rules;
    }

    public function calculate(): int
    {
        $price = 0;
        foreach ($this->rules as $rule) {
            $price = $rule->calcPrice($this->order, $price);
        }
        return $price;
    }
}