<?php

namespace App\Tests\Service\ShippingPrice;

use PHPUnit\Framework\TestCase;
use App\Service\ShippingPrice\WeightShippingRule;
use App\MoreleEntity\Order;

class WeightShippingRuleTest extends TestCase
{
    private WeightShippingRule $rule;

    protected function setUp(): void
    {
        $this->rule = new WeightShippingRule();
    }

    public function testCalcPrice(): void
    {
        $order = $this->createStub(Order::class);

        $order->method('getTotalWeight')
            ->willReturnOnConsecutiveCalls(5, 5.1, 7.9);

        $this->assertSame(1000, $this->rule->calcPrice($order, 1000));
        $this->assertSame(1300, $this->rule->calcPrice($order, 1000));
        $this->assertSame(1900, $this->rule->calcPrice($order, 1000));

    }
    
}