<?php namespace LPP\Shopping\tax\strategy;

/**
 * Class TaxContext
 *
 * @author lpp
 */
class TaxContext
{
    /**
     * @var TaxInterface
     */
    private $strategy;

    private $taxStrategies;

    function __construct()
    {
        $taxStrategies = array();
        $taxStrategies["PL"] = new TaxPL();
        $taxStrategies["DE"] = new TaxDE();
        $taxStrategies["UK"] = new TaxUK();
        $this->taxStrategies = $taxStrategies;
    }


    /**
     * @param string $country
     *
     * @return void
     */
    public function setCountry($country)
    {
         if(isset($this->taxStrategies[$country])) {
             $this->strategy = $this->taxStrategies[$country];
         } else {
             throw new \InvalidArgumentException('Unknown or not implemented tax for: ' . $country);
        }
    }

    /**
     * @return TaxInterface $strategy
     */
    public function getTax()
    {
        /*
         * Instead of checking if the strategy is set use NullStrategy
         * object to handle the lack of initialization situations.
         * It encapsulates the implementation decisions of how to do nothing and hides
         * those details from the Context.
         * Or move the Strategy in the constructor
         */
        if (!$this->strategy) {
            throw new \LogicException("Strategy is not set");
        }
        return $this->strategy;
    }

    /**
     * @param float $net
     *
     * @return float
     */
    public function calculateTax($net)
    {
        return $this->strategy->count($net);
    }

}
