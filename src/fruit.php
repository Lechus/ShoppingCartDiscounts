<?php namespace LPP\Shopping;

class Fruit
{
    private $unitPrice;
    private $productName;
    private $priceAndDiscounts;

    public function __construct($productName, $priceAndDiscounts = array())
    {
        $this->productName = $productName;
        $this->priceAndDiscounts = $priceAndDiscounts;
    }

    /**
     * {@inheritdoc}
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * {@inheritdoc}
     */
    public function getPriceAndDiscounts()
    {
        return $this->priceAndDiscounts;
    }

    /**
     * {@inheritdoc}
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

}
