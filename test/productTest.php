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
     * @covers LPP\Shopping\Fruit::getProductName
     */
    public function testGetProductName()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $this->assertEquals('Lemon', $this->object->getName());
    }

    /**
     * @covers LPP\Shopping\Fruit::getPriceAndDiscounts
     */
    public function testGetPriceAndDiscounts()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $priceAndDiscounts = array('11' => 0.45);

        $this->assertEquals($priceAndDiscounts, $this->object->getDiscounts());
    }

    /**
     * @covers LPP\Shopping\Fruit::getType
     */
    public function testGetProductType()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $this->assertEquals(0.50, $this->object->getUnitPrice());
    }

}
