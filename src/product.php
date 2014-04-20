<?php namespace LPP\Shopping;

class Product {

    protected $productName;
    protected $priceAndDiscounts;

    public function __construct($productName, $priceAndDiscounts = array()) {
        $this->productName = $productName;
        $this->priceAndDiscounts = $priceAndDiscounts;
    }

    public function getProductName() {
        return $this->productName;
    }

    /**
     * Get the price and discounts of the product depending on quantity
     *
     * @return array The price and discounts of $product
     */
    public function getPriceAndDiscounts() {
        return $this->priceAndDiscounts;
    }

}
