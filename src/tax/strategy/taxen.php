<?php namespace tax\strategy;

/**
 * Class TaxUK
 *
 * @author lpp
 */
class TaxEN implements TaxInterace {

    /**
     * {@inheritdoc}
     */
    public function count($net) {
        $tax = 0.15 * $net;
        return number_format($tax, 2);
    }

}