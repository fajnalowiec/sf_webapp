<?php

namespace App\Tests\Service\ShippingPrice;

use PHPUnit\Framework\TestCase;
use App\Service\ShippingPrice\CountryShippingRule;
use App\MoreleEntity\CountryShippingFee;
use App\MoreleEntity\Order;

class CountryShippingRuleTest extends TestCase
{
    private CountryShippingRule $rule;

    protected function setUp(): void
    {
        $this->rule = new CountryShippingRule(new CountryShippingFee());
    }

    public function testCalcPrice(): void
    {
        $order = $this->createStub(Order::class);

        $order->method('getDestinationCountry')
            ->willReturnOnConsecutiveCalls('PL', 'US', 'DE', 'XX', 'dummy');

        $this->assertSame(1000, $this->rule->calcPrice($order, 0));
        $this->assertSame(5000, $this->rule->calcPrice($order, 0));
        $this->assertSame(2000, $this->rule->calcPrice($order, 0));
        $this->assertSame(3999, $this->rule->calcPrice($order, 0));
        $this->assertSame(3999, $this->rule->calcPrice($order, 0));

    }
    
}