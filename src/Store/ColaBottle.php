<?php

namespace Store;

class ColaBottle extends CabinetItem
{
    public function __construct(string $label, float $price, float $weight)
    {
        parent::__construct($label, $price, $weight);
    }
}
