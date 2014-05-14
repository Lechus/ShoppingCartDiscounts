<?php

use LPP\Shopping\Cart;
use LPP\Shopping\Fruit;

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

    
    public function testCartImplementsArrayObject()
    {
        echo "\n Executing " . __FUNCTION__ . PHP_EOL;
        $this->assertInstanceOf('ArrayObject', $this->cart);
    }
    
    
    /**
     * @covers LPP\Shopping\Cart::count
     */
    public function testCartIsInitiallyEmpty()
    {
        echo "\n Executing " . __FUNCTION__ . PHP_EOL;

        //Asert
        $this->assertEquals(0, $this->cart->count());
    }

    /**
     * @covers LPP\Shopping\Cart::count
     * @covers LPP\Shopping\Cart::addItem
     */
    public function testCanAddOneItemToCart()
    {
        echo "\n Executing " . __FUNCTION__ . PHP_EOL;

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
    public function testAddItemWithAmountLessThanZero()
    {
        echo "\n Executing " . __FUNCTION__ . PHP_EOL;

        //Arrange
        $product = $this->getSampleProduct();

        //Act
        $result = $this->cart->addItem($product, -1);

        //Asert
        $this->assertFalse($result);
    }

    /**
     * @covers LPP\Shopping\Cart::addItem
     * @covers LPP\Shopping\Cart::getPriceOf
     */
    public function testAddItemChain()
    {
        echo "\n Executing " . __FUNCTION__ . PHP_EOL;

        $product = $this->getSampleProduct();
        $this->cart->addItem($product, 1)->addItem($product, 10);

        $this->assertEquals(0.45, $this->cart->getPriceOf($product));
    }

    /**
     * @covers LPP\Shopping\Cart::getPriceOf
     * @covers LPP\Shopping\Cart::addItem
     * @dataProvider providerProducts
     */
    public function testGetPriceOf($productName, $priceAndDiscounts, $amount, $exceptedPrice)
    {
        //echo "\n Executing " . __FUNCTION__ . PHP_EOL;

        $product = $this->getSampleProduct($productName, $priceAndDiscounts);
        $this->cart->addItem($product, $amount);

        $this->assertEquals($exceptedPrice, $this->cart->getPriceOf($product));
    }

    /**
     * @covers LPP\Shopping\Cart::getTotalSum
     * @todo   Implement testGetTotalSum().
     */
    public function testGetTotalSum()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }


    private function getSampleProduct($productName = 'Lemon', $priceAndDiscounts = array('0' => 0.50, '11' => 0.45))
    {
        $product = $this->getMockBuilder('\\Lpp\\Shopping\\ProductInterface')
                ->setMethods(array('getProductName', 'getPriceAndDiscounts'))
                ->getMock();
        $product->expects($this->any())
                ->method('getPrice')
                ->will($this->returnValue($productName));
        
        $product->expects($this->any())
                ->method('getPriceAndDiscounts')
                ->will($this->returnValue($priceAndDiscounts));
        
        return $product;
    }
    

    /* productName, (product)priceAndDiscounts, (product) Amount, (product) Excepted Price Per Item */
    public function providerProducts()
    {

        return array(
            array('Lemon', array('0' => 0.50, '11' => 0.45), 0, 0.50),
            array('Lemon', array('0' => 0.50, '11' => 0.45), 1, 0.50),
            array('Lemon', array('0' => 0.50, '11' => 0.45), 10, 0.50),
            array('Lemon', array('0' => 0.50, '11' => 0.45), 11, 0.45),
            array('Lemon', array('0' => 0.50, '11' => 0.45), 20, 0.45),
            array('Lemon', array('0' => 0.50, '11' => 0.45), 21, 0.45),
            array('Lemon', array('0' => 0.50, '11' => 0.45), 100, 0.45),
            array('Lemon', array('0' => 0.50, '11' => 0.45), 101, 0.45),
            array('Lemon', array('0' => 0.50, '11' => 0.45), 1000, 0.45),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.14), 0, 0.20),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.14), 1, 0.20),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.14), 10, 0.20),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.14), 11, 0.20),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.14), 20, 0.20),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.14), 21, 0.18),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.14), 100, 0.18),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.14), 101, 0.14),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.14), 1000, 0.14),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.12), 0, 0.20),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.12), 1, 0.20),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.12), 10, 0.20),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.12), 11, 0.20),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.12), 20, 0.20),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.12), 21, 0.18),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.12), 100, 0.18),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.12), 101, 0.12),
            array('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.12), 1000, 0.12)
        );
    }
    
}
