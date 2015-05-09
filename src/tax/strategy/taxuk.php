<?php namespace LPP\Shopping\tax\strategy;

/**
 * Class TaxUK
 *
 * @author lpp
 */
class TaxUK implements TaxInterface
{
    /**
     * {@inheritdoc}
     */
    public function count($net) {
        $tax = 0.15 * $net;
        return number_format($tax, 2);
    }
}
