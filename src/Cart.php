<?php
require_once('CartInterface.php');

class Cart extends ArrayObject implements CartInterface {

    protected $_items;

    public function __construct() {
        $this->_items = array();
        /*
          Construct the underlying ArrayObject using
          $this->_items as the foundation array. This
          is important to ensure that the features
          of ArrayObject are available to your object.
         */
        parent::__construct($this->_items);
    }

    public function getTotalSum() {
        $total = 0;
        $maxLength = $this->_findMaxLength();
        foreach ($this->_items as $item) {
            $totalForProduct = $this->getPriceOf($item['product']) * $item['amount'];
            $total +=  $totalForProduct;
            echo str_pad($item['amount'], 10);
            echo str_pad($item['product']->getProductName(), $maxLength+2);
            echo 'Ł' . number_format($totalForProduct, 2);
            echo "\n";
        }
        echo str_pad('-', 10 + $maxLength+2, "-" ) . "\n";
        echo str_pad('Total:', 10 + $maxLength+2) . 'Ł' . number_format($total, 2);
    }

    /**
     * Add an item to the shopping cart
     *
     * @param Product $product Instance of the Product we're adding
     * @param int $amount The amount of $product
     *
     * @return void
     */
    public function addItem(Product $product, $amount) {
        if (0 > $amount) {
            return false;
        }
        $productKeyInCart = $this->_searchItem($product->getProductName());
        if ($productKeyInCart > -1) {
            $this->_items[$productKeyInCart]['amount'] += $amount;
        } else {
            $this->_items[] = array('product' => $product, 'amount' => $amount);
        }
    }

    /**
     * Get the price of the product depending on how many are already in the shopping cart
     *
     * @param Product $product Product The product to determine price for
     * @return float The price of $product
     */
    public function getPriceOf(Product $product) {
        foreach ($this->_items as $itemValue) {
            if ($itemValue['product']->getProductName() == $product->getProductName()) {
                return number_format($this->_calculateDiscountedPrice($itemValue), 2);
            }
        }
        return false;
    }

     /**
     * Get the key of product in the cart
     *
     * @param productName
     * @return int array key
     */
    private function _searchItem($productName) {
        if (0 > count($this->_items)) {
            return -1;
        }

        foreach ($this->_items as $key => $item) {
            if ($item['product']->getProductName() === $productName) {
                return $key;
            }
        }
    }

    private function _calculateDiscountedPrice($product) {
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
    private function _findMaxLength() {
        $length  = 0;
        foreach ($this->_items as $itemValue) {
            $lengthOfProductName = $this->getLengthOfString($itemValue['product']->getProductName());
            if ($length < $lengthOfProductName) {
                $length = $lengthOfProductName;
            }
        }
        return $length;
    }
    
    private function getLengthOfString($productName) {
        return mb_strlen($productName, 'UTF-8');
    }
}
    