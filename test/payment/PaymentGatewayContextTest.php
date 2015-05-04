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
     * @expectedException InvalidArgumentException
     */
    public function testSetPaymentGatewayException() {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $this->object->setPaymentGateway("Unknown");
    }

    /**
     * @expectedException LogicException
     */
    public function testGetPaymentGatewayException() {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $this->object->getPaymentGateway();
    }

    /**
     * @covers LPP\Shopping\tax\strategy\TaxContext::getTax
     */
    public function testGetPaymentGatewayReturnInstanceOf() {
        echo PHP_EOL, 'Executing ', __METHOD__ , PHP_EOL;

        $this->object->setPaymentGateway("PayPal");

        $this->assertInstanceOf( __NAMESPACE__ . '\PayPalGateway', $this->object->getPaymentGateway());
    }
}
