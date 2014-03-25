<?php

interface ProductDiscount {
   /**
    * Create a NEW discount code and return the instance of
    *
    * @param $code string      the discount code
    * @param $discount float   price adjustment in % (ex:        
    * @param $options array    (optional) an array of options :
    *                            'expire'   => timestamp    (optional)
    *                            'limited'  => int          (optional)
    * @return ProductDiscount                         
    */
   static public function create($code, $discount, $options = NULL);

  

 
   public function getDiscount();  // return float
 
   public function consume();      // apply this discount now

   public function consumeAll();   // invalidate this discount for future use
}
