<?php namespace LPP\Shopping\payment\strategy;

class PayPalGateway implements PaymentGatewayInterface
{

    /**
     * {@inheritdoc}
     */
    public function pay($amount)
    {
        echo "Paid ", number_format($amount, 2), " using PayPal.";
    }

}
