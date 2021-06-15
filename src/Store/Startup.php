<?php


namespace Store;


class Startup
{
    public function __construct()
    {

    }

    public function run($itemType)
    {
        $requiredPerRackItemsTotal = 20;

        $racks = [
            new Rack([], $requiredPerRackItemsTotal),
            new Rack([], $requiredPerRackItemsTotal),
            new Rack([], $requiredPerRackItemsTotal),
        ];

        $racksTotal = count($racks);

        $cabinet = new Cabinet(
            $racks,
            $requiredPerRackItemsTotal,
            $racksTotal,
            $itemType
        );

        echo "
        <h1>Cabinet App</h1>
        <ul>
            <li>Racks total: $racksTotal</li>
            <li> Items per rack: $requiredPerRackItemsTotal</li>
            <li> Racks item type: $itemType</li>
        </ul>  
            
        ";

        foreach (range(1, $requiredPerRackItemsTotal) as $i) {
            $cabinet->addNewItem(0, new $itemType($itemType, 1, 0.250));
        }
        foreach (range(1, $requiredPerRackItemsTotal) as $i) {
            $cabinet->addNewItem(1, new $itemType($itemType, 1, 0.250));
        }
        foreach (range(1, $requiredPerRackItemsTotal) as $i) {
            $cabinet->addNewItem(2, new $itemType($itemType, 1, 0.250));
        }
        $cabinet->fetchItem(0, 1);
        $cabinet->fetchItem(0, 3);
        $cabinet->fetchItem(0, 44);
        $cabinet->fetchItem(0, 19);
        $cabinet->fetchItem(0, 5);
        // un-comment the below lines to run through exceptions as user cannot add items to the cabinet if it meets the requirements!
//        $cabinet->addNewItem(1, new ColaBottle(ColaBottle::class, 1, 0.250));
//        $cabinet->addNewItem(1, new ColaBottle(ColaBottle::class, 1, 0.250));
//        $cabinet->addNewItem(1, new ColaBottle(ColaBottle::class, 1, 0.250));

//        $cabinet->fetchItem(0, rand(0,19));
//        $cabinet->fetchItem(0, rand(0,19));
//        $cabinet->fetchItem(0, rand(0,19));
//        $cabinet->fetchItem(0, rand(0,19));


//        $cabinet->addNewItem(0, new ColaBottle(ColaBottle::class, 1, 0.250));
//        $cabinet->addNewItem(0, new ColaBottle(ColaBottle::class, 1, 0.250));
//        $cabinet->addNewItem(0, new ColaBottle(ColaBottle::class, 1, 0.250));
//        $cabinet->addNewItem(0, new ColaBottle(ColaBottle::class, 1, 0.250));

    }
}