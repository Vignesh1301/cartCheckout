<?php

use App\Checkout;
use App\ProductPrice;
use App\ProductDiscount;

final class ProductPriceTest extends PHPUnit_Framework_TestCase {
    public function testPriceFor()
    {
        $this->assertEquals((new ProductPrice(15))->priceFor(1), 15);
        $this->assertEquals((new ProductPrice(20))->priceFor(2), 40);
        $this->assertEquals((new ProductPrice(100))->priceFor(5), 500);
    }

    public function testPriceForWithDiscount()
    {
        $this->assertEquals((new ProductPrice(40, new ProductDiscount(4, 20)))->priceFor(5), 180);
        $this->assertEquals((new ProductPrice(50, new ProductDiscount(3, 20)))->priceFor(4), 180);
        
    }
}