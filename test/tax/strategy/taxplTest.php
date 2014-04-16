<?php namespace tax\strategy;

class TaxPLTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var TaxContext
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new TaxPL;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers tax\strategy\TaxContext::setCountry
     * @todo   Implement testSetCountry().
     */
    public function testCount() {
        echo PHP_EOL, 'Executing ',  __FUNCTION__, PHP_EOL;
        
         $this->assertEquals(0.23, $this->object->count(1));
    }

}