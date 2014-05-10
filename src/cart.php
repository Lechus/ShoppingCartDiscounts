<?php namespace LPP\Shopping;

use LPP\Shopping\Utils\StringHelper;

/**
 * Cart
 *
 * Represents a storage container for shopper to keep a collection of items
 */
class Cart extends \ArrayObject implements CartInterface
{
    /** @var array */
    private $items;

    public function __construct()
    {
        $this->items = array();
        /*
          Construct the underlying ArrayObject using
          $this->items as the foundation array. This
          is important to ensure that the features
          of ArrayObject are available to your object.
         */
        parent::__construct($this->items);
    }

    public function getTotalSum()
    {
        $output = "";
        $total = 0;
        $maxLength = $this->findMaxLength();
        foreach ($this->items as $item) {
            $totalForProduct = $this->getPriceOf($item['product']) * $item['amount'];
            $total +=  $totalForProduct;
            $output .= str_pad($item['amount'], 10);
            $output .= str_pad($item['product']->getProductName(), $maxLength+2);
            $output .= 'Ł' . number_format($totalForProduct, 2);
            $output .= PHP_EOL;
        }
        $output .= str_pad('-', 10 + $maxLength+2, "-" ) . PHP_EOL;
        $output .= str_pad('Total:', 10 + $maxLength+2) . 'Ł' . number_format($total, 2);
        return $output;
    }

    /**
     * Add an item to the shopping cart
     *
     * @param Product $product Instance of the Product we're adding
     * @param int     $amount  The amount of $product
     *
     * @return void
     */
    public function addItem(Product $product, $amount)
    {
        if (0 > $amount) {
            return false;
        }
        $productKeyInCart = $this->searchItem($product->getProductName());
        if ($productKeyInCart > -1) {
            $this->items[$productKeyInCart]['amount'] += $amount;
        } else {
            $this->items[] = array('product' => $product, 'amount' => $amount);
        }
        
        return $this;
    }

    /**
     * Get the price of the product depending on how many are already in the shopping cart
     *
     * @param  Product $product Product The product to determine price for
     * @return float   The price of $product
     */
    public function getPriceOf(Product $product)
    {
        foreach ($this->items as $itemValue) {
            if ($itemValue['product']->getProductName() == $product->getProductName()) {
                return number_format($this->calculateDiscountedPrice($itemValue), 2);
            }
        }

        return false;
    }

    /**
     * Returns the number of items currently in the cart
     *
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }


    
     /**
     * Get the key of product in the cart
     *
     * @param productName
     * @return int array key
     */
    private function searchItem($productName)
    {
        if (0 > count($this->items)) {
            return -1;
        }

        foreach ($this->items as $key => $item) {
            if ($item['product']->getProductName() === $productName) {
                return $key;
            }
        }
    }

    private function calculateDiscountedPrice($product)
    {
        $amount = $product['amount'];
        $discountedPrice = $product['product']->getPriceAndDiscounts()[0];

        foreach ($product['product']->getPriceAndDiscounts() as $minAmount => $productPrice) {
            if ($amount >= $minAmount) {
                $discountedPrice = $productPrice;
            }
        }

        return $discountedPrice;
    }

     /**
     * Get the length of the longest product name in the cart
     *
     * @param none
     * @return int length of the longest product name
     */
    private function findMaxLength()
    {
        $length  = 0;
        foreach ($this->items as $itemValue) {
            $lengthOfProductName = $this->getLengthOfString($itemValue['product']->getProductName());
            if ($length < $lengthOfProductName) {
                $length = $lengthOfProductName;
            }
        }

        return $length;
    }

    private function getLengthOfString($productName)
    {
        return (new StringHelper())->getLengthOfString($productName);
    }
    
}
