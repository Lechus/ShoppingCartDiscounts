<?php

use tax\strategy as Tax;

/*** Autoload class files ***/
function __autoload($class){
    $file = strtolower($class) . '.php';
    if(file_exists(__DIR__.DIRECTORY_SEPARATOR.$file)) {
        require_once $file;
    }
}

$cart = new Cart();

$lemon = new Product('Lemon', array('0' => 0.50, '11' => 0.45));
$cart->addItem($lemon, 10);
echo $cart->getPriceOf($lemon) . "\n";

$cart->addItem($lemon, 1);
echo $cart->getPriceOf($lemon) . "\n";

$tomato = new Product('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.14));
$cart->addItem($tomato, 33);
echo $cart->getPriceOf($tomato) . "\n";

$orange = new Product('Orange', array('0' => 0.20, '21' => 0.18, '101' => 0.12));
$cart->addItem($orange, 10);
echo $cart->getPriceOf($orange) . "\n";

echo $cart->getTotalSum();

/*Here will come Tax*/
$tax = new Tax\TaxContext();
$tax->setCountry("PL");

echo "\n";
echo "Tax in Poland: " . $tax->getTax()->count($cart->getPriceOf($orange));
echo "\n";
$tax->setCountry("EN");
echo "Tax in UK: " .  $tax->getTax()->count($cart->getPriceOf($orange));
echo "\n";
$tax->setCountry("DE");
echo "Tax in Germany: " .  $tax->getTax()->count($cart->getPriceOf($orange));