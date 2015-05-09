<?php namespace LPP\Shopping;

require_once '../vendor/autoload.php';

use LPP\Shopping\payment\strategy\PaymentGatewayContext;
use LPP\Shopping\tax\strategy\TaxContext;
use LPP\Shopping\Utils\StringHelper;
use LPP\Shopping\View\View;

$view = new View();
$stringHelper = new StringHelper();

$cart = new Cart($view, $stringHelper);

$lemon = new Product('Lemon', 0.50,  array('11' => 0.45));
$cart->addItem($lemon, 10);
echo 'Lemon [10 items], price for 1 item:', $cart->getPriceOf($lemon), PHP_EOL;

$cart->addItem($lemon, 1);
echo 'Lemon [11 items] price for 1 item:', $cart->getPriceOf($lemon), PHP_EOL;

$tomato = new Product('Tomato', 0.20, array('21' => 0.18, '101' => 0.14));
$cart->addItem($tomato, 33);
echo 'Tomato [33 items] price for 1 item:', $cart->getPriceOf($tomato), PHP_EOL;

$orange = new Product('Orange', 0.20, array('21' => 0.18, '101' => 0.12));
$cart->addItem($orange, 102);
echo 'Orange [102 items] price for 1 item:',$cart->getPriceOf($orange), PHP_EOL;

echo PHP_EOL, 'Your basket:', PHP_EOL;
echo $cart->getTotalSum();


/*Here will come some Tax information*/
$tax = new TaxContext();

echo PHP_EOL, PHP_EOL;
$tax->setCountry("UK");
echo "Orange: Tax in UK: " .  $tax->calculateTax($cart->getPriceOf($orange));


/*Time for payment*/
$paymentGateway = new PaymentGatewayContext();

echo PHP_EOL, PHP_EOL;
$paymentGateway->setPaymentGateway("PayPal");
echo "Process payment with PayPal: ", $paymentGateway->processPayment($cart->getTotal());
echo PHP_EOL;