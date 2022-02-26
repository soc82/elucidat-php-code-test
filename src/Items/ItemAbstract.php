<?php

namespace App\Items;

use App\Item;

abstract class ItemAbstract extends Item
{
   public function __construct(int $quality, int $sellIn)
    {
        parent::__construct(static::ITEM_NAME, $quality, $sellIn);
    }

    abstract public function nextDay();

    /**
     * SPEC TEST: Item Name
     * @return string Item name
     */
    public function getName() :string
    {
        return $this->name;
    }

    /**
     * SPEC TEST: Item Quality
     * @return int Value
     */
    public function getQuality() :int
    {
        return $this->quality;
    }

    /**
     * SPEC TEST: SellIn of Item
     * @return int Value
     */
    public function getSellIn() :int
    {
        return $this->sellIn;
    }

    /**
     * After Possible Sell Date
     * @return bool
     */
    protected function afterSellByDate() :bool
    {
        return $this->sellIn < 0;
    }

    /**
     * Removes quality value of the item
     * @return self
     */
    protected function zeroQuality() :self
    {
        $this->quality = 0;
        return $this;
    }

    /**
     * Decreases quality value. Stops at 0 as quality cannot be negative
     * @return self
     */
    protected function decreaseQuality(int $number) :self
    {
        $this->quality -= $number;
        if ($this->quality < 0) {
            $this->quality = 0;
        }
        return $this;
    }

    /**
     * Increases quality value by a given number (takes care of a maximum quality value)
     *
     * @return self
     */
    protected function increaseQuality(int $number) :self
    {
        $this->quality += $number;

        if ($this->quality > 50) {
            // The Quality of an item is never more than 50
            $this->quality = 50;
        }

        return $this;
    }
    /**
     * Decreases sellIn value by 1
     *
     * @return self
     */
    protected function decreaseSellIn() :self
    {
        $this->sellIn--;

        return $this;
    }

    
}