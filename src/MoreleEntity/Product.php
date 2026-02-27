<?php

namespace App\MoreleEntity;

class Product
{

    private string $name;
    private int $price;
    private float $weight;

    public function __construct(string $name, int $price, float $weight)
    {
        $this->name = $name;
        $this->price = $price;
        $this->weight = $weight;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }
}