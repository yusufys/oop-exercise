<?php

namespace Store;

class Cabinet
{
    const FULL_CAPACITY_USED = 1;
    const HALF_CAPACITY_USED = 2;
    const CAPACITY_NOT_USED = 3;
    private array $racks;
    private int $requiredPerRackCapacity;
    private int $requiredRacksTotal;
    private string $rackItemType;
    private bool $isDoorOpen = false;
    private $capacityStatus;

    /**
     * Cabinet constructor.
     * @param array $racks
     * @param int $requiredPerRackCapacity
     * @param int $requiredRacksTotal
     * @param string $rackItemType
     * @param int $itemsTotal
     */
    public function __construct(array $racks, int $requiredPerRackCapacity, int $requiredRacksTotal, string $rackItemType)
    {
        $this->racks = $racks;
        $this->requiredPerRackCapacity = $requiredPerRackCapacity;
        $this->requiredRacksTotal = $requiredRacksTotal;
        $this->rackItemType = $rackItemType;
    }

    /**
     * fetches an item from specific rack and item from that rack
     * @param int $rackIndex
     * @param int $itemIndex
     * @return CabinetItem|null
     */
    public function fetchItem(int $rackIndex, int $itemIndex)
    {
        $rack = $this->getRackByIndex($rackIndex);
        $item = $rack->fetchItem($itemIndex);
        if ($item) {
            $this->setCabinetItemsCapacity();
            Support::fetchItemMessage("Fetching item: " . $item->getLabel() . "<br>");
        }
        Support::fetchItemMessage("Fetching item: <span style='background-color: #4ca90e;color:white;font-weight: bolder'>NOT FOUND</span><br>");
        return $item;
    }

    /**
     * returns a rack object instance provided from the racks array
     * @param int $rackIndex
     * @return Rack
     */
    public function getRackByIndex(int $rackIndex): Rack
    {
        return $this->racks[$rackIndex];
    }

    /**
     * sets the cabinet's capacity
     */
    public function setCabinetItemsCapacity()
    {
        $allItems = $this->getAllRacksItems();
        $totalItems = count($allItems);

        Support::capacityStatusMessage("total items: $totalItems <br>");

        $allRacksItemsTotal = $this->requiredPerRackCapacity * $this->requiredRacksTotal;

        if ($totalItems === $allRacksItemsTotal) {
            $this->capacityStatus = static::FULL_CAPACITY_USED;
        } elseif ($totalItems === 0) {
            $this->capacityStatus = static::CAPACITY_NOT_USED;
        }
        $this->capacityStatus = static::HALF_CAPACITY_USED;
    }

    /**
     * gets all racks' items then convert it into a single-big-array of items
     * @return false|array
     */
    public function getAllRacksItems()
    {
        return call_user_func_array('array_merge', $this->mapAllRacksItems());
    }

    /**
     * helper function to map through all racks' items
     * @return array
     */
    public function mapAllRacksItems(): array
    {
        return array_map(
            function (Rack $item) {
                return $item->getItems();
            }, $this->racks
        );
    }

    /**
     * adds new item to a specific rack
     * @param int $rackIndex
     * @param CabinetItem $item
     * @throws \Exception
     */
    public function addNewItem(int $rackIndex, CabinetItem $item)
    {
        $this->checkCabinetCapacity();
        $rack = $this->getRackByIndex($rackIndex);
        $rack->addItem($item);
        $this->setCabinetItemsCapacity();
        Support::addItemMessage("Added new item: " . $item->getLabel() . "<br>");
    }

    /**
     * checks if cabinet has reached capacity, if so, it will throw an error to the user
     * @throws \Exception
     */
    private function checkCabinetCapacity()
    {
        if ($this->hasCabinetReachedCapacity()) {
            throw new \Exception("Capacity has been exceeded");
        }
    }

    /**
     * checks if cabinet has reached its max. capacity or not
     * @return bool
     */
    public function hasCabinetReachedCapacity()
    {
        return $this->capacityStatus === static::FULL_CAPACITY_USED;
    }

    /**
     * checks whether the cabinet's door is open or not
     * @return bool
     */
    public function getIsDoorOpen()
    {
        return $this->isDoorOpen;
    }

    /**
     * toggles the status of cabinet's door (if true => false or false => true)
     */
    public function setIsDoorOpen()
    {
        $this->isDoorOpen = !$this->isDoorOpen;
    }
}

