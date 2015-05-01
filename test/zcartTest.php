<?php

use LPP\Shopping\Cart;

class CartTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Cart
     */
    protected $cart;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->cart = new Cart;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->cart = null;
    }

    public static function tearDownAfterClass()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;
        
    }
    
    public function testCartImplementsArrayObject()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;
        $this->assertInstanceOf('ArrayObject', $this->cart);
    }
        
    /**
     * @covers LPP\Shopping\Cart::count
     */
    public function testCartIsInitiallyEmpty()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        //Asert
        $this->assertEquals(0, $this->cart->count());
    }

    /**
     * @covers LPP\Shopping\Cart::count
     * @covers LPP\Shopping\Cart::addItem
     */
    public function testCanAddOneItemToCart()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        //Arrange
        $product = $this->getSampleProduct();

        //Act
        $this->cart->addItem($product, 1);

        //Asert
        $this->assertEquals(1, $this->cart->count());  
    }
    
    /**
     * @covers LPP\Shopping\Cart::addItem
     */
    public function testCannotAddItemWithAmountLessThanZero()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        //Arrange
        $product = $this->getSampleProduct();

        //Act
        $result = $this->cart->addItem($product, -1);

        //Asert
        $this->assertFalse($result);
        $this->assertEquals(0, $this->cart->count());
    }


    /**
     * @covers LPP\Shopping\Cart::addItem
     * @covers LPP\Shopping\Cart::getPriceOf
     */
    public function testAddItemChain()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $product = $this->getSampleProduct();

        $this->cart->addItem($product, 1)->addItem($product, 10);

        $this->assertEquals(0.45, $this->cart->getPriceOf($product));
        $this->assertEquals(1, $this->cart->count());
    }


    /**
     * @covers LPP\Shopping\Cart::deleteItem
     * @covers LPP\Shopping\Cart::addItem
     */
    public function testCanRemoveProductFromCart()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $product = $this->getSampleProduct();

        $this->cart->addItem($product, 1);
        $this->cart->deleteItem($product);

        $this->assertEquals(0, $this->cart->count());
    }


    /**
     * @covers LPP\Shopping\Cart::updateItem
     * @covers LPP\Shopping\Cart::getPriceOf
     * @covers LPP\Shopping\Cart::addItem
     */
    public function testCanUpdateProductQuantityInCart()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $product = $this->getSampleProduct();

        $this->cart->addItem($product, 1);
        $this->cart->updateItem($product, 11);

        $this->assertEquals(1, $this->cart->count());
        $this->assertEquals(0.45, $this->cart->getPriceOf($product));
    }


    /**
     * @covers LPP\Shopping\Cart::updateItem
     * @covers LPP\Shopping\Cart::getPriceOf
     * @covers LPP\Shopping\Cart::addItem
     */
    public function testUpdateProductQuantityToZeroREmoveItFromCart()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $product = $this->getSampleProduct();

        $this->cart->addItem($product, 1);
        $this->cart->updateItem($product, 0);

        $this->assertEquals(0, $this->cart->count());
    }

    /**
     * @covers LPP\Shopping\Cart::getTotalSum
     */
    public function testGetTotalSum()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $product = $this->getSampleProduct();

        $this->cart->addItem($product, 11);

        $this->assertContains('£4.95', $this->cart->getTotalSum());
    }

    /**
     * @covers LPP\Shopping\Cart::getPriceOf
     * @covers LPP\Shopping\Cart::addItem
     * @dataProvider providerProducts
     */
    public function testGetPriceOf($productName, $unitPrice, $discounts, $quantity, $exceptedPrice)
    {
        $product = $this->getSampleProduct($productName, $unitPrice, $discounts);

        $this->cart->addItem($product, $quantity);

        $this->assertEquals($exceptedPrice, $this->cart->getPriceOf($product));
    }


    private function getSampleProduct($productName = 'Lemon', $unitPrice = 0.50, $discounts = array('11' => 0.45))
    {
        $product = new \LPP\Shopping\Product($productName, $unitPrice, $discounts);

        return $product;
    }
    
    /* productName,  unitPrice, (product)Discounts, (product) Quantity, (product) Excepted Price Per Item */
    public function providerProducts()
    {
        return array(
            array('Lemon', 0.50, array('11' => 0.45), 0, false),
            array('Lemon', 0.50, array('11' => 0.45), 1, 0.50),
            array('Lemon', 0.50, array('11' => 0.45), 10, 0.50),
            array('Lemon', 0.50, array('11' => 0.45), 11, 0.45),
            array('Lemon', 0.50, array('11' => 0.45), 20, 0.45),
            array('Lemon', 0.50, array('11' => 0.45), 21, 0.45),
            array('Lemon', 0.50, array('11' => 0.45), 100, 0.45),
            array('Lemon', 0.50, array('11' => 0.45), 101, 0.45),
            array('Lemon', 0.50, array('11' => 0.45), 1000, 0.45),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.14), 0, false),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.14), 1, 0.20),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.14), 10, 0.20),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.14), 11, 0.20),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.14), 20, 0.20),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.14), 21, 0.18),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.14), 100, 0.18),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.14), 101, 0.14),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.14), 1000, 0.14),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.12), 0, false),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.12), 1, 0.20),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.12), 10, 0.20),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.12), 11, 0.20),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.12), 20, 0.20),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.12), 21, 0.18),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.12), 100, 0.18),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.12), 101, 0.12),
            array('Tomato', 0.20, array('21' => 0.18, '101' => 0.12), 1000, 0.12)
        );
    }
    
}
