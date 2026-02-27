<?php

namespace App\MoreleEntity;

use App\MoreleEntity\CartPosition;

class Cart
{

    /**
     * @var CartPosition[] $positions
     */
    private array $positions = [];

    public function addCartPosition(CartPosition $cartPosition)
    {
        $this->positions[] = $cartPosition;
    }

    public function getPositions(): array
    {
        return $this->positions;
    }

    //need to add it for deserialization so the json array is cast to CartPosition[]

    /**
     * @param CartPosition[] $positions
     */
    public function setPositions(array $positions): void
    {
        $this->positions = $positions;
    }

}