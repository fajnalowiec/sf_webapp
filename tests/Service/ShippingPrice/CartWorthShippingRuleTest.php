<?php

namespace App\Tests\Service\ShippingPrice;

use PHPUnit\Framework\TestCase;
use App\Service\ShippingPrice\CartWorthShippingRule;
use App\MoreleEntity\Order;
use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;

#[AllowMockObjectsWithoutExpectations]
class CartWorthShippingRuleTest extends TestCase
{
    private CartWorthShippingRule $rule;

    protected function setUp(): void
    {
        $this->rule = new CartWorthShippingRule();
    }

    public function testCalcPrice(): void
    {
        $order = $this->createMock(Order::class);

        $order->method('getTotalPrice')
            ->willReturnOnConsecutiveCalls(30000, 40000, 40000);

        $order->method('getDestinationCountry')
            ->willReturnOnConsecutiveCalls('PL', 'US');

        $this->assertSame(2000, $this->rule->calcPrice($order, 2000));
        $this->assertSame(0, $this->rule->calcPrice($order, 2000));
        $this->assertSame(1000, $this->rule->calcPrice($order, 2000));

    }
    
}