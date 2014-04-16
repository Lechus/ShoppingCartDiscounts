<?php namespace tax\strategy;

/**
 * Class TaxPL
 *
 * @author lpp
 */
class TaxPL implements TaxInterace {

    /**
     * {@inheritdoc}
     */
    public function count($net) {
        $tax = 0.23 * $net;
        return number_format($tax, 2);
    }

}