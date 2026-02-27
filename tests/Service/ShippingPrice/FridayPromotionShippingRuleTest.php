<?php

namespace App\Tests\Service\ShippingPrice;

use PHPUnit\Framework\TestCase;
use App\Service\ShippingPrice\FridayPromotionShippingRule;
use App\MoreleEntity\Order;

class FridayPromotionShippingRuleTest extends TestCase
{
    private FridayPromotionShippingRule $rule;

    protected function setUp(): void
    {
        $this->rule = new FridayPromotionShippingRule();
    }

    public function testCalcPrice(): void
    {
        $order = $this->createMock(Order::class);
        $dateFormat = 'd-m-Y H:i';

        $order->expects($this->exactly(2))
            ->method('getTimestamp')
            ->willReturnOnConsecutiveCalls(
                \DateTime::createFromFormat($dateFormat, '27-02-2026 15:30')->getTimestamp(),
                \DateTime::createFromFormat($dateFormat, '23-02-2026 15:30')->getTimestamp(),
            );

        $this->assertSame(0, $this->rule->calcPrice($order, 0));
        $this->assertSame(1000, $this->rule->calcPrice($order, 2000));
        $this->assertSame(2000, $this->rule->calcPrice($order, 2000));

    }
    
}