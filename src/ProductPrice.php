<?php

namespace App;

class ProductPrice {
    private $singlePrice;
    private $discounts;

    public function __construct($singlePrice, $discounts = [])
    {
        $this->singlePrice = $singlePrice;

        $this->discounts =
            $discounts instanceof ProductDiscount ?
            [$discounts] : $discounts;
    }

    public function priceFor($count)
    {
        $discount = $this->_getDiscountByCount($count);
        $price    = $count * $this->singlePrice;

        if ($discount)
            $price -= $discount->discountFor($count);

        return $price;
    }

    protected function _getDiscountByCount($count)
    {
        $memoDiscount = null;

        foreach ($this->discounts as $discount) {
            if ($count >= $discount->getProductsCount()) {
                $memoDiscount = $discount;
            }
        }

        return $memoDiscount;
    }
}
