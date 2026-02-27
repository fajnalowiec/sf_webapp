<?php

namespace App\MoreleEntity;

use App\MoreleEntity\Cart;

class Order
{
    private Cart $cart;
    private int $timestamp;
    private string $destinationCountry;
    private int $totalPrice = 0;
    private float $totalWeight = 0;

    public function __construct(Cart $cart, int $timestamp, string $destinationCountry)
    {
        $this->cart = $cart;
        $this->timestamp = $timestamp;
        $this->destinationCountry = $destinationCountry;

        $cartPositions = $this->cart->getPositions();
        foreach ($cartPositions as $cartPosition) {
            $this->totalPrice += $cartPosition->getAmount() * $cartPosition->getProduct()->getPrice();
            $this->totalWeight += $cartPosition->getAmount() * $cartPosition->getProduct()->getWeight();
        }
    }

    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    public function getTotalWeight(): float
    {
        return $this->totalWeight;
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getDestinationCountry(): string
    {
        return $this->destinationCountry;
    }

}