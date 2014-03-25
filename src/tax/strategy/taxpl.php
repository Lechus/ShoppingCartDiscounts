<?php
namespace tax\strategy;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TaxPL
 *
 * @author lpp
 */
class TaxPL implements TaxInterace {

    public function count($net) {
        $tax = 0.23 * $net;
        return number_format($tax, 2);
    }

}
