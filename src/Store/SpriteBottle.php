<?php

namespace Store;

class SpriteBottle extends CabinetItem
{
    public function __construct(string $label, float $price, float $weight)
    {
        parent::__construct($label, $price, $weight);
    }
}
