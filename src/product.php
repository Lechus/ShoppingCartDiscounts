<?php namespace LPP\Shopping;

class Product
{
    private $unitPrice;
    private $name;
    private $discounts;

    public function __construct($productName, $unitPrice, $discounts = array())
    {
        $this->name = $productName;
        $this->unitPrice = $unitPrice;
        $this->discounts = $discounts;
    }


    public function getName()
    {
        return $this->name;
    }


    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * Get the price and discounts of the product depending on quantity
     *
     * @return array The price and discounts of $product
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }





}
