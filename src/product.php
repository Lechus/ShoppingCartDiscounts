<?php

class Product {
  protected $_productName;
  protected $_priceAndDiscounts;
      
  public function __construct($productName, $priceAndDiscounts = array()) {
    $this->_productName = $productName;
    $this->_priceAndDiscounts = $priceAndDiscounts;
  }
  
  public function getProductName() {
    return $this->_productName;
  }
  
  public function getPriceAndDiscounts() {
    return $this->_priceAndDiscounts;
  }  
  
}