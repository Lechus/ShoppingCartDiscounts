<?php namespace LPP\Shopping\tax\strategy;

/**
 * Class TaxInterface
 *
 * @author lpp
 */
interface TaxInterface
{

    /**
     * @param float $net
     *
     * @return float
     */
    public function count($net);
}
