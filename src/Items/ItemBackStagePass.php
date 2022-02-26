<?php
/**
 * ITEM: BackStagePass
 * - Quality drops to 0 after sell by date
 * - If greater than 10 days Before Sell By Date increase by 2
 * - If greater than 5 days Before Sell By Date increase by 3
 * @param array $this->items 
 * @return void
*/

namespace App\Items;

use App\Item;

class ItemBackStagePass extends ItemAbstract
{
    const ITEM_NAME = 'Backstage passes to a TAFKAL80ETC concert';

    public function nextDay()
    {
        // SELLIN decrease by 1
        $this->decreaseSellIn();

        if ($this->afterSellByDate()) {
             // QUALITY 0 after concert dated passed
            $this->zeroQuality();
        } else {
            // QUALITY increase due to Item type (backstage passes)
            $this->increaseQuality($this->qualityChange());
        }
    }

    /**
     * Calculates the quality change
     * Number variables depend on sell in being either 10 days or 5 days before concert. 
     * Default quality increase 1
     * @return int Number
     */
    private function qualityChange() :int
    {
        // SELLIN 5 days or less | Quality Increase by 3
        if ($this->sellIn < 5) {
            return 3;
        }
        // SELLIN 5 days or less | Quality Increase by 2
        if ($this->sellIn < 10) {
            return 2;
        }
        // SELLIN 10 days or above | Quality Increase by 1
        return 1;
    }
}