<?php

namespace App;
use App\Items;
use App\Items\ItemAbstract;

class GildedRose
{
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }


    public function getItem($which = null)
    {
        return ($which === null
            ? $this->items
            : $this->items[$which]
        );
    }

    /**
     * Set NextDay calculation of each Item
     * - Loops through items and updates based on the Items Indivdual requirements. 
     * - These are based in the 'src/Items' folder.
     */

    public function nextDay()
    {

        foreach ($this->items as $item) {
           
            if ($item instanceof ItemAbstract) {
                $item->nextDay();
            } else {
                error_log("\n Error InstanceOf Name does not exist: ".$item->name, 3, "./errors_log.log");
            }
        }
    }
}
