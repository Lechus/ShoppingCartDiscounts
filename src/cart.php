<?php namespace LPP\Shopping;

use LPP\Shopping\Utils\StringHelper;
use LPP\Shopping\View\View;

/**
 * Cart
 *
 * Represents a storage container for shopper to keep a collection of items
 */
class Cart extends \ArrayObject implements CartInterface
{
    /** @var array */
    protected $items = array();

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
        $data = array();

        $data['maxLength'] = $this->findMaxLength();

        $total = 0;

        foreach ($this->items as $item) {
            $item['totalPrice'] = $this->getPriceOf($item['product']) * $item['quantity'];
            $data['items'][] = $item;
            $total += $item['totalPrice'];
        }

        $data['total'] = $total;

        $view = new View($data);
        return $view->render();
    }

    /**
     * Add an item to the shopping cart
     *
     * @param Product $product Instance of the Product we're adding
     * @param int $quantity The quantity of $product
     *
     * @return self
     */
    public function addItem(Product $product, $quantity)
    {
        if (0 >= $quantity) {
            return false;
        }
        $productKeyInCart = $this->searchItem($product->getName());
        if ($productKeyInCart > -1) {
            $this->items[$productKeyInCart]['quantity'] += $quantity;
        } else {
            $this->items[] = array('product' => $product, 'quantity' => $quantity);
        }

        return $this;
    }

    public function updateItem(Product $product, $quantity)
    {
        if (0 === $quantity) {
            return $this->deleteItem($product);
        }

        $productKeyInCart = $this->searchItem($product->getName());
        if (0 > $productKeyInCart) {
            return false;
        }
        if (($quantity > 0) && ($quantity != $this->items[$productKeyInCart]['quantity'])) {
            $this->items[$productKeyInCart]['quantity'] = $quantity;
        }

        return $this;
    }

    public function deleteItem(Product $product)
    {
        $productKeyInCart = $this->searchItem($product->getName());
        if (0 > $productKeyInCart) {
            return false;
        }

        unset($this->items[$productKeyInCart]);

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
            if ($itemValue['product']->getName() == $product->getName()) {
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
            if ($item['product']->getName() === $productName) {
                return $key;
            }
        }
    }

    private function calculateDiscountedPrice($product)
    {
        $amount = $product['quantity'];
        $discountedPrice = $product['product']->getUnitPrice();

        foreach ($product['product']->getDiscounts() as $minAmount => $productPrice) {
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
        $length = 0;
        foreach ($this->items as $itemValue) {
            $lengthOfProductName = $this->getLengthOfString($itemValue['product']->getName());
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
