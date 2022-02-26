<?php
/**
 * ITEM: Conjured
 * - "Conjured" items degrade in Quality twice as fast as normal items
 * - Extends from Default with change to Quality Only required
 * @param array $this->items 
 * @return void
*/

namespace App\Items;

use App\Item;

class ItemConjured extends ItemDefault
{
    const ITEM_NAME = 'Conjured Mana Cake';

    protected function qualityChange() :int
    {
        return parent::qualityChange()*2;
    }
}