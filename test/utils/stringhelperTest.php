<?php namespace LPP\Shopping\Utils;

class StringHelperTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var StringHelper
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new StringHelper;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    /**
     * @covers LPP\Shopping\Utils\StringHelper::getLengthOfString
     */
    public function testGetLengthOfString()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;
        $this->assertEquals(5, $this->object->getLengthOfString("£4.95"));
    }


    /**
     * @covers LPP\Shopping\Utils\StringHelper::getLengthOfString
     */
    public function testGetLengthOfLatinString()
    {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;
        $this->assertEquals(3, $this->object->getLengthOfString("495"));
    }

}
