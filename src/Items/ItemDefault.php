<?php

/**
 * ITEM: Normal
 * - Quality decreases by 1 
 * - After Sell by, Quality decreases Twice as fast
 * - Can extend to other items with the same next day function i.e. decrease sell in and decrease quality
 * @param array $this->items 
 * @return void
*/


namespace App\Items;

use App\Item;

class ItemDefault extends ItemAbstract
{
    const ITEM_NAME = 'normal';

    public function nextDay()
    {
        // SELLIN decrease by 1
        $this->decreaseSellIn();

        // QUALITY decrease due to Item type (normal)
        $this->decreaseQuality($this->qualityChange());
    }

    /**
     * Calculates the quality change
     * If sell by date, quality decreases twice as fast
     * @return int Number
     */
    protected function qualityChange() :int
    {
       return $this->afterSellByDate() ? 2 : 1;
    }
}