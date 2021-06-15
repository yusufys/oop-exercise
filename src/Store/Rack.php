<?php


namespace Store;

/**
 * Rack or in other words ledge in the Cabinet machines.
 * Each rack has maximum amount if items to be aligned
 * inside of it.
 * Class Rack
 * @package Store
 */
class Rack
{
    protected int $itemsCapacity;
    protected int $itemsTotal = 0;
    private array $items;

    public function __construct(array $items, int $itemsCapacity)
    {
        $this->items = $items;
        $this->itemsCapacity = $itemsCapacity;
    }

    /**
     * adds new item to the rack and updates the items list by + 1
     * @param CabinetItem $item
     * @throws \Exception in case it reaches the max. allowed capacity
     */
    public function addItem(CabinetItem $item)
    {
        if ($this->hasRackReachedCapacity()) {
            throw new \Exception("Capacity has been exceeded in this rack!");
        }
        $this->items[] = $item;
        $this->itemsTotal++;
    }

    /**
     * checks whether the rack has reached its max. capacity of items
     * @return bool
     */
    private function hasRackReachedCapacity()
    {
        $currentItemsTotal = count($this->getItems());
        return $currentItemsTotal >= $this->itemsCapacity;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * fetches an item and updates items list by minus 1
     * @param $itemIndex
     * @return CabinetItem|null
     */
    public function fetchItem($itemIndex): ?CabinetItem
    {
        if (isset($this->items[$itemIndex])) {
            $item = $this->items[$itemIndex];
            $this->itemsTotal--;
            unset($this->items[$itemIndex]);
            return $item;
        }
        return null;
    }


}