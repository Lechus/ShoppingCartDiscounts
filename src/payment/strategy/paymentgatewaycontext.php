<?php namespace LPP\Shopping\payment\strategy;

class PaymentGatewayContext
{
    /**
     * @var PaymentGatewayInterface
     */
    private $strategy;

    /**
     * @param string $paymentGateway
     *
     * @return void
     */
    public function setPaymentGateway($paymentGateway)
    {
        $className = __NAMESPACE__ . '\\' . $paymentGateway . "Gateway";
        if(class_exists($className)) {
            // return a new paymentGateway object
            $this->strategy = new $className();
        } else {
            throw new \InvalidArgumentException('Unknown or not implemented payment gateway for: ' . $paymentGateway);
        }

    }


    public function processPayment($amountToPay)
    {
        $this->strategy->pay($amountToPay);
    }

}
