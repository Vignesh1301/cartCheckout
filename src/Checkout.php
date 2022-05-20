<?php

namespace App;

class Checkout {
    private $pricingRules = [];
    private $itemsCounts  = [];
    private $itemsPrices  = [];

    public function __construct($itemsStr, $pricingRules)
    {
        $this->pricingRules = $pricingRules;

        foreach ($this->pricingRules as $type => $productPrice) {
            $this->itemsCounts[$type]  = substr_count($itemsStr, $type);
            $this->itemsPrices[$type]  = $productPrice->priceFor($this->itemsCounts[$type]);
        }
    }

    public function total()
    {
        return array_sum($this->itemsPrices);
    }
}