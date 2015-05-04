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

    /**
     * @return PaymentGatewayInterface $strategy
     */
    public function getPaymentGateway()
    {
        /*
         * Instead of checking if the strategy is set use NullStrategy
         * object to handle the lack of initialization situations.
         * It encapsulates the implementation decisions of how to do nothing and hides
         * those details from the Context.
         * Or move the Strategy in the constructor
         */
        if (!$this->strategy) {
            throw new \LogicException("Strategy is not set");
        }
        return $this->strategy;
    }

}
