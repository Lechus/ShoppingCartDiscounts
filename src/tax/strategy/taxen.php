<?php
namespace tax\strategy;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TaxUK
 *
 * @author lpp
 */
class TaxEN implements TaxInterace {

    public function count($net) {
        $tax = 0.15 * $net;
        return number_format($tax, 2);
    }

}
