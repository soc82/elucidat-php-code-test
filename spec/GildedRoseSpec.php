<?php

use App\GildedRose;

use App\Items\ItemAgedBrie;
use App\Items\ItemBackStagePass;
use App\Items\ItemConjured;
use App\Items\ItemDefault;
use App\Items\ItemSulfuras;

describe('Gilded Rose', function () {
    describe('next day', function () {
        context('normal Items', function () {
            it('check the name is set correctly', function () {
                $gr = new GildedRose([new ItemDefault(10, 5)]);
                expect($gr->getItem(0)->getName())->toBe('normal');
            });
            it('updates normal items before sell date', function () {
                $gr = new GildedRose([new ItemDefault(10, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(9);
                expect($gr->getItem(0)->getSellIn())->toBe(4);
            });
            it('updates normal items on the sell date', function () {
                $gr = new GildedRose([new ItemDefault(10, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(8);
                expect($gr->getItem(0)->getSellIn())->toBe(-1);
            });
            it('updates normal items after the sell date', function () {
                $gr = new GildedRose([new ItemDefault(10, -5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(8);
                expect($gr->getItem(0)->getSellIn())->toBe(-6);
            });
            it('updates normal items with a quality of 0', function () {
                $gr = new GildedRose([new ItemDefault(0, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(0);
                expect($gr->getItem(0)->getSellIn())->toBe(4);
            });
        });
        context('Brie Items', function () {
            it('check the name is set correctly', function () {
                $gr = new GildedRose([new ItemAgedBrie(10, 5)]);
                expect($gr->getItem(0)->getName())->toBe('Aged Brie');
            });
            it('updates Brie items before the sell date', function () {
                $gr = new GildedRose([new ItemAgedBrie(10, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(11);
                expect($gr->getItem(0)->getSellIn())->toBe(4);
            });
            it('updates Brie items before the sell date with maximum quality', function () {
                $gr = new GildedRose([new ItemAgedBrie(50, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(50);
                expect($gr->getItem(0)->getSellIn())->toBe(4);
            });
            it('updates Brie items on the sell date', function () {
                $gr = new GildedRose([new ItemAgedBrie(10, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(12);
                expect($gr->getItem(0)->getSellIn())->toBe(-1);
            });
            it('updates Brie items on the sell date, near maximum quality', function () {
                $gr = new GildedRose([new ItemAgedBrie(49, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(50);
                expect($gr->getItem(0)->getSellIn())->toBe(-1);
            });
            it('updates Brie items on the sell date with maximum quality', function () {
                $gr = new GildedRose([new ItemAgedBrie(50, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(50);
                expect($gr->getItem(0)->getSellIn())->toBe(-1);
            });
            it('updates Brie items after the sell date', function () {
                $gr = new GildedRose([new ItemAgedBrie(10, -10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(12);
                expect($gr->getItem(0)->getSellIn())->toBe(-11);
            });
            it('updates Brie items after the sell date with maximum quality', function () {
                $gr = new GildedRose([new ItemAgedBrie(50, -10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(50);
                expect($gr->getItem(0)->getSellIn())->toBe(-11);
            });
        });
        context('Sulfuras Items', function () {
            it('check the name is set correctly', function () {
                $gr = new GildedRose([new ItemSulfuras(10, 5)]);
                expect($gr->getItem(0)->getName())->toBe('Sulfuras, Hand of Ragnaros');
            });
            it('updates Sulfuras items before the sell date', function () {
                $gr = new GildedRose([new ItemSulfuras(10, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(10);
                expect($gr->getItem(0)->getSellIn())->toBe(5);
            });
            it('updates Sulfuras items on the sell date', function () {
                $gr = new GildedRose([new ItemSulfuras(10, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(10);
                expect($gr->getItem(0)->getSellIn())->toBe(0);
            });
            it('updates Sulfuras items after the sell date', function () {
                $gr = new GildedRose([new ItemSulfuras(10, -1)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(10);
                expect($gr->getItem(0)->getSellIn())->toBe(-1);
            });
        });
        context('Backstage Passes', function () {
            it('check the name is set correctly', function () {
                $gr = new GildedRose([new ItemBackStagePass(10, 5)]);
                expect($gr->getItem(0)->getName())->toBe('Backstage passes to a TAFKAL80ETC concert');
            });
            it('updates Backstage pass items long before the sell date', function () {
                $gr = new GildedRose([new ItemBackStagePass(10, 11)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(11);
                expect($gr->getItem(0)->getSellIn())->toBe(10);
            });
            it('updates Backstage pass items close to the sell date', function () {
                $gr = new GildedRose([new ItemBackStagePass(10, 10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(12);
                expect($gr->getItem(0)->getSellIn())->toBe(9);
            });
            it('updates Backstage pass items close to the sell data, at max quality', function () {
                $gr = new GildedRose([new ItemBackStagePass(50, 10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(50);
                expect($gr->getItem(0)->getSellIn())->toBe(9);
            });
            it('updates Backstage pass items very close to the sell date', function () {
                $gr = new GildedRose([new ItemBackStagePass(10, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(13); // goes up by 3
                expect($gr->getItem(0)->getSellIn())->toBe(4);
            });
            it('updates Backstage pass items very close to the sell date, at max quality', function () {
                $gr = new GildedRose([new ItemBackStagePass(50, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(50);
                expect($gr->getItem(0)->getSellIn())->toBe(4);
            });
            it('updates Backstage pass items with one day left to sell', function () {
                $gr = new GildedRose([new ItemBackStagePass(10, 1)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(13);
                expect($gr->getItem(0)->getSellIn())->toBe(0);
            });
            it('updates Backstage pass items with one day left to sell, at max quality', function () {
                $gr = new GildedRose([new ItemBackStagePass(50, 1)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(50);
                expect($gr->getItem(0)->getSellIn())->toBe(0);
            });
            it('updates Backstage pass items on the sell date', function () {
                $gr = new GildedRose([new ItemBackStagePass(10, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(0);
                expect($gr->getItem(0)->getSellIn())->toBe(-1);
            });
            it('updates Backstage pass items after the sell date', function () {
                $gr = new GildedRose([new ItemBackStagePass(10, -1)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(0);
                expect($gr->getItem(0)->getSellIn())->toBe(-2);
            });
        });
        context("Conjured Items", function () {
            it('check the name is set correctly', function () {
                $gr = new GildedRose([new ItemConjured(10, 5)]);
                expect($gr->getItem(0)->getName())->toBe('Conjured Mana Cake');
            });
            it('updates Conjured items before the sell date', function () {
                $gr = new GildedRose([new ItemConjured(10, 10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(8);
                expect($gr->getItem(0)->getSellIn())->toBe(9);
            });
            it('updates Conjured items at zero quality', function () {
                $gr = new GildedRose([new ItemConjured(0, 10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(0);
                expect($gr->getItem(0)->getSellIn())->toBe(9);
            });
            it('updates Conjured items on the sell date', function () {
                $gr = new GildedRose([new ItemConjured(10, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(6);
                expect($gr->getItem(0)->getSellIn())->toBe(-1);
            });
            it('updates Conjured items on the sell date at 0 quality', function () {
                $gr = new GildedRose([new ItemConjured(0, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(0);
                expect($gr->getItem(0)->getSellIn())->toBe(-1);
            });
            it('updates Conjured items after the sell date', function () {
                $gr = new GildedRose([new ItemConjured(10, -10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(6);
                expect($gr->getItem(0)->getSellIn())->toBe(-11);
            });
            it('updates Conjured items after the sell date at zero quality', function () {
                $gr = new GildedRose([new ItemConjured(0, -10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->getQuality())->toBe(0);
                expect($gr->getItem(0)->getSellIn())->toBe(-11);
            });
        });
    });
});