<?php
namespace LPP\Shopping\payment\strategy;


class PaymentGatewayContextTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var PaymentGatewayContext
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new  PaymentGatewayContext();
    }

    /**
     * @covers LPP\Shopping\payment\strategy\PaymentGatewayContext::setPaymentGateway
     * @expectedException InvalidArgumentException
     */
    public function testSetPaymentGatewayException() {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $this->object->setPaymentGateway("Unknown");
    }


}
