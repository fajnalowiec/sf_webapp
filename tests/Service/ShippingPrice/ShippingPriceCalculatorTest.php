<?php

namespace App\Tests\Service\ShippingPrice;

use PHPUnit\Framework\TestCase;
use App\MoreleEntity\Order;
use App\MoreleEntity\CountryShippingFee;
use App\Service\ShippingPrice\CountryShippingRule;
use App\Service\ShippingPrice\WeightShippingRule;
use App\Service\ShippingPrice\ShippingPriceCalculator;

class ShippingPriceCalculatorTest extends TestCase
{
    private ShippingPriceCalculator $calc;

    protected function setUp(): void
    {
        $order = $this->createStub(Order::class);
        $order->method('getDestinationCountry')->willReturn('DE');
        $order->method('getTotalWeight')->willReturn(5.6);

        $this->calc = new ShippingPriceCalculator($order, [
            new CountryShippingRule(new CountryShippingFee()),
            new WeightShippingRule()
        ]);
    }

    public function testCalculate(): void
    {        
        $this->assertSame(2300, $this->calc->calculate());
    }
    
}