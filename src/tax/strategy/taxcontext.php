<?php namespace LPP\Shopping\tax\strategy;

/**
 * Class TaxContex
 *
 * @author lpp
 */
class TaxContext
{
    /**
     * @var TaxInterface
     */
    private $strategy;

    /**
     * @param TaxInterface $strategy
     *
     * @return void
     */
    public function setCountry($country)
    {
        switch ($country) {
            case "PL":
                $this->strategy = new TaxPL();
                break;
            case "DE":
                $this->strategy = new TaxDE();
                break;
            case "EN":
                $this->strategy = new TaxEN();
                break;
            default:
                throw new \InvalidArgumentException('Unknown or not implemented tax for: ' . $country);
        }
    }

    /**
     * @return TaxInterface $strategy
     */
    public function getTax()
    {
        /*
         * Iinstead of checking if the strategy is set use NullStategy
         *  object to handle the lack of initialization situations.
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
