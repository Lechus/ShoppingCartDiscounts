<?php namespace tax\strategy;

/**
 * Class TaxDE
 *
 * @author lpp
 */
class TaxDE implements TaxInterace {

    /**
     * {@inheritdoc}
     */
    public function count($net) {
        $tax = 0.19 * $net;
        return number_format($tax, 2);
    }

}