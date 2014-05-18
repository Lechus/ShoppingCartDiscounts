<?php namespace LPP\Shopping\tax\strategy;

class TaxContextTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var TaxContext
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new TaxContext;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetCountryException() {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $this->object->setCountry("Unknown");
    }

    /**
     * @expectedException LogicException
     */
    public function testGetTaxException() {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $this->object->getTax();
    }
    
    /**
     * @covers LPP\Shopping\tax\strategy\TaxContext::getTax
     */
    public function testGetTaxReturnInstanceOf() {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $this->object->setCountry("PL");
        
        $this->assertInstanceOf( __NAMESPACE__ . '\TaxPL', $this->object->getTax());
    }

}
