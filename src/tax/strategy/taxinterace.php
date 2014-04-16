<?php namespace tax\strategy;

/**
 * Class TaxInterace
 *
 * @author lpp
 */
interface TaxInterace {

    /**
     * @param float $net
     *
     * @return float
     */
    public function count($net);
}
