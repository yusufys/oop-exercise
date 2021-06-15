<?php

namespace Store;

class CabinetItem
{
    protected string $label;
    protected float $price;
    protected float $weight;

    public function __construct(string $label, float $price, float $weight)
    {
        $this->label = $label;
        $this->price = $price;
        $this->weight = $weight;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): void
    {
        $this->weight = $weight;
    }


}
