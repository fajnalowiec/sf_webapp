<?php

namespace App\MoreleEntity;

use App\MoreleEntity\Product;

class CartPosition
{
    private int $amount;
    private Product $product;

    public function __construct(int $amount, Product $product)
    {
        $this->amount = $amount;
        $this->product = $product;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}