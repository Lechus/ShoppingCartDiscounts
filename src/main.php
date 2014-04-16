<?php
require_once '/vendor/autoload.php';

use tax\strategy as Tax;

$cart = new Cart();

$lemon = new Product('Lemon', array('0' => 0.50, '11' => 0.45));
$cart->addItem($lemon, 10);
echo 'Lemon [10 items], price for 1 item:', $cart->getPriceOf($lemon), PHP_EOL;

$cart->addItem($lemon, 1);
echo 'Lemon [11 items] price for 1 item:', $cart->getPriceOf($lemon), PHP_EOL;

$tomato = new Product('Tomato', array('0' => 0.20, '21' => 0.18, '101' => 0.14));
$cart->addItem($tomato, 33);
echo 'Tomato [33 items] price for 1 item:', $cart->getPriceOf($tomato), PHP_EOL;

$orange = new Product('Orange', array('0' => 0.20, '21' => 0.18, '101' => 0.12));
$cart->addItem($orange, 102);
echo 'Orange [102 items] price for 1 item:',$cart->getPriceOf($orange), PHP_EOL;

echo PHP_EOL, 'Your basket:', PHP_EOL;
echo $cart->getTotalSum();

/*Here will come Tax information*/
$tax = new Tax\TaxContext();
$tax->setCountry("PL");

echo PHP_EOL, PHP_EOL;
echo "Orange: Tax in Poland: " . $tax->getTax()->count($cart->getPriceOf($orange));
echo PHP_EOL;
$tax->setCountry("EN");
echo "Orange: Tax in UK: " .  $tax->getTax()->count($cart->getPriceOf($orange));
echo PHP_EOL;
$tax->setCountry("DE");
echo "Orange: Tax in Germany: " .  $tax->getTax()->count($cart->getPriceOf($orange));