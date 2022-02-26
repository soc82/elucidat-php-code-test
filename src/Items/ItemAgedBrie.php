<?php
/**
 * ITEM: Aged Brie
 * - Increases in Quality older it gets
 * - After Sell by, Quality increases Twice as fast
 * @param array $this->items 
 * @return void
*/

namespace App\Items;

use App\Item;

class ItemAgedBrie extends ItemAbstract
{
    const ITEM_NAME = 'Aged Brie';

    public function nextDay()
    {
         // SELLIN decrease by 1
        $this->decreaseSellIn();

        // QUALITY increase due to Item type (aged brie)
        $this->increaseQuality($this->qualityChange());
    }

    /**
     * Calculates the quality change
     * If sell by date, quality increases twice as fast
     * @return int Number
     */
    private function qualityChange() :int
    {
        return $this->afterSellByDate() ? 2 : 1;
    }
}