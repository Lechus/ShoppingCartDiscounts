<?php
namespace tax\strategy;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TaxContex
 *
 * @author lpp
 */
class TaxContext {

    private $strategy;

    public function setCountry($country) {
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
        }
    }

    public function getTax() {
        return $this->strategy;
    }

}
