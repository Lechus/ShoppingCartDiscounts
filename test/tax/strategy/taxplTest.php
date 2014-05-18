<?php namespace LPP\Shopping\tax\strategy;

class TaxPLTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var TaxContext
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new TaxPL;
    }

    /**
     * @covers LPP\Shopping\tax\strategy\TaxContext::setCountry
     */
    public function testCount()
    {
        echo PHP_EOL, 'Executing ', __METHOD__, PHP_EOL;

        $this->assertEquals(0.23, $this->object->count(1));
    }

}
