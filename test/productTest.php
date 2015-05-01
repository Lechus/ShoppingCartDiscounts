<?php

use LPP\Shopping\Product;

class ProductTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Product
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $productName = 'Lemon';
        $productUnitPrice = 0.50;
        $priceAndDiscounts = array( '11' => 0.45);
        $this->object = new Product($productName, $productUnitPrice, $priceAndDiscounts);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->object = null;
    }

    /**
     * @covers LPP\Shopping\Product::getName
     */
    public function testGetName()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $this->assertEquals('Lemon', $this->object->getName());
    }

    /**
     * @covers LPP\Shopping\Product::getDiscounts
     */
    public function testGetDiscounts()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $discounts = array('11' => 0.45);

        $this->assertEquals($discounts, $this->object->getDiscounts());
    }

    /**
     * @covers LPP\Shopping\Product::getUnitPrice
     */
    public function testGetUnitPrice()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $this->assertEquals(0.50, $this->object->getUnitPrice());
    }

}
