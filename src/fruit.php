<?php namespace LPP\Shopping;

class Fruit implements Product
{

    private $productType = 'fruit';
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
    public function getProductType()
    {
        return $this->productType;
    }

}
