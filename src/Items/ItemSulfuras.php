<?php
/**
 * ITEM: Sulfuras
 * - "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
 * - No Action required here
 * @param array $this->items 
 * @return void
*/

namespace App\Items;

use App\Item;

class ItemSulfuras extends ItemAbstract
{
    
        const ITEM_NAME = 'Sulfuras, Hand of Ragnaros';
    
        public function nextDay()
        {
            // nothing to be done here
        }
    
}