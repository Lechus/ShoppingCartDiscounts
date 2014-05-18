<?php namespace LPP\Shopping;

/**
* Interface ProductInterface
*
* @package ShoppingCart
*/
interface ProductInterface
{

    /**
     * Return product name
     * @return string
     */
    public function getProductName();

    /**
     * Get the price and discounts of the product depending on quantity
     *
     * @return array The price and discounts of $product
     */
    public function getPriceAndDiscounts();

    /**
     * Return product type name
     * @return string name
     */
    public function getProductType();
}
