<?php

use LPP\Shopping\Fruit;

class FruitTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Fruit
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $productName = 'Lemon';
        $priceAndDiscounts = array('0' => 0.50, '11' => 0.45);
        $this->object = new Fruit($productName, $priceAndDiscounts);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    /**
     * @covers LPP\Shopping\Fruit::getProductName
     */
    public function testGetProductName()
    {
        echo PHP_EOL, 'Executing ', __FUNCTION__, PHP_EOL;

        $this->assertEquals('Lemon', $this->object->getProductName());
    }

    /**
     * @covers LPP\Shopping\Fruit::getPriceAndDiscounts
     */
    public function testGetPriceAndDiscounts()
    {
        echo PHP_EOL, 'Executing ', __FUNCTION__, PHP_EOL;

        $priceAndDiscounts = array('0' => 0.50, '11' => 0.45);

        $this->assertEquals($priceAndDiscounts, $this->object->getPriceAndDiscounts());
    }

    /**
     * @covers LPP\Shopping\Fruit::getType
     */
    public function testGetProductType()
    {
        echo PHP_EOL, 'Executing ', __FUNCTION__, PHP_EOL;

        $this->assertEquals('fruit', $this->object->getProductType());
    }

}
