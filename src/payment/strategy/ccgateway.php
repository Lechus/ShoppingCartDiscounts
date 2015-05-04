<?php namespace LPP\Shopping\payment\strategy;

class CCGateway implements PaymentGatewayInterface
{
    /**
     * {@inheritdoc}
     */
    public function pay($amount)
    {
        echo "Paid ", number_format($amount, 2), " using CC.";
    }
}
