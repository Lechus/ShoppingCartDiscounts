<?php

class ProductTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Product
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $productName = 'Lemon';
        $priceAndDiscounts = array('0' => 0.50, '11' => 0.45);
        $this->object = new Product($productName, $priceAndDiscounts);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers Product::getProductName
     * @todo   Implement testGetProductName().
     */
    public function testGetProductName() {
        echo PHP_EOL, 'Executing ',  __FUNCTION__, PHP_EOL;
        
        $this->assertEquals('Lemon', $this->object->getProductName());
    }

    /**
     * @covers Product::getPriceAndDiscounts
     * @todo   Implement testGetPriceAndDiscounts().
     */
    public function testGetPriceAndDiscounts() {
        echo PHP_EOL, 'Executing ',  __FUNCTION__, PHP_EOL;
        
        $priceAndDiscounts = array('0' => 0.50, '11' => 0.45);
        
        $this->assertEquals($priceAndDiscounts, $this->object->getPriceAndDiscounts());
    }

}
