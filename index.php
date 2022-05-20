<?php

require 'vendor/autoload.php';

use App\Checkout;
use App\ProductPrice;
use App\ProductDiscount;
use App\ProductDiscountByProduct;

// work with static price

$pricingRules = [
    'A' => new ProductPrice(50, new ProductDiscount(3, 20)),
    'B' => new ProductPrice(30, new ProductDiscount(2, 15)),
    'C' => new ProductPrice(20, [new ProductDiscount(2, 2), new ProductDiscount(3, 10)]),
    'D' => new ProductPrice(15, new ProductDiscount(1, 10)),
    'E' => new ProductPrice(5),
];

$checkout = new Checkout('AD', $pricingRules);
echo "Checkout Total : ";
echo($checkout->total());

