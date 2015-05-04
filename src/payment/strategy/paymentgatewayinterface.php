<?php namespace LPP\Shopping\payment\strategy;

/**
 * Class PaymentGatewayInterface
 *
 * @author lpp
 */
interface PaymentGatewayInterface
{

    /**
     * @param $amount
     * @return string
     */
    public function pay($amount);
}
