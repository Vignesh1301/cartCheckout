<?php

use App\Checkout;
use App\ProductPrice;
use App\ProductDiscount;


final class CheckotTest extends PHPUnit_Framework_TestCase {
    public function testTotalPriceOfGivenItems()
    {
        $pricingRules = [
            'A' => new ProductPrice(50, new ProductDiscount(3, 20)),
            'B' => new ProductPrice(30, new ProductDiscount(2, 15)),
            'C' => new ProductPrice(20, [new ProductDiscount(2, 2), new ProductDiscount(3, 10)]),
            'D' => new ProductPrice(15),
            'E' => new ProductPrice(5),
        ];

        $this->assertEquals((new Checkout('A', $pricingRules))->total(), 50);
        $this->assertEquals((new Checkout('B', $pricingRules))->total(), 30);
        $this->assertEquals((new Checkout('C', $pricingRules))->total(), 20);
        $this->assertEquals((new Checkout('D', $pricingRules))->total(), 15);
        $this->assertEquals((new Checkout('E', $pricingRules))->total(), 5);
        
    }

    public function testTotalPriceOfGivenItemsWithMultipleDiscounts()
    {
        $pricingRules = [
            'A' => new ProductPrice(50,  new ProductDiscount(3, 20)),
            'B' => new ProductPrice(30, new ProductDiscount(2, 15)),
        ];

        $this->assertEquals((new Checkout('AAA', $pricingRules))->total(), 130);
        $this->assertEquals((new Checkout('BB', $pricingRules))->total(), 45);
        $this->assertEquals((new Checkout('CC', $pricingRules))->total(), 38);
        $this->assertEquals((new Checkout('CCC', $pricingRules))->total(), 50);
        $this->assertEquals((new Checkout('AD', $pricingRules))->total(), 55);
    }
}