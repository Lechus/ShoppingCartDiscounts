<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'LPP\\Shopping\\Cart' => $baseDir . '/src/cart.php',
    'LPP\\Shopping\\CartInterface' => $baseDir . '/src/cartinterface.php',
    'LPP\\Shopping\\Product' => $baseDir . '/src/product.php',
    'LPP\\Shopping\\Utils\\StringHelper' => $baseDir . '/src/utils/stringhelper.php',
    'LPP\\Shopping\\View\\View' => $baseDir . '/src/view/view.php',
    'LPP\\Shopping\\View\\ViewInterface' => $baseDir . '/src/view/viewinterface.php',
    'LPP\\Shopping\\payment\\strategy\\CCGateway' => $baseDir . '/src/payment/strategy/ccgateway.php',
    'LPP\\Shopping\\payment\\strategy\\PayPalGateway' => $baseDir . '/src/payment/strategy/paypalgateway.php',
    'LPP\\Shopping\\payment\\strategy\\PaymentGatewayContext' => $baseDir . '/src/payment/strategy/paymentgatewaycontext.php',
    'LPP\\Shopping\\payment\\strategy\\PaymentGatewayInterface' => $baseDir . '/src/payment/strategy/paymentgatewayinterface.php',
    'LPP\\Shopping\\payment\\strategy\\StripeGateway' => $baseDir . '/src/payment/strategy/stripegateway.php',
    'LPP\\Shopping\\tax\\strategy\\TaxContext' => $baseDir . '/src/tax/strategy/taxcontext.php',
    'LPP\\Shopping\\tax\\strategy\\TaxDE' => $baseDir . '/src/tax/strategy/taxde.php',
    'LPP\\Shopping\\tax\\strategy\\TaxEN' => $baseDir . '/src/tax/strategy/taxen.php',
    'LPP\\Shopping\\tax\\strategy\\TaxInterface' => $baseDir . '/src/tax/strategy/taxinterface.php',
    'LPP\\Shopping\\tax\\strategy\\TaxPL' => $baseDir . '/src/tax/strategy/taxpl.php',
);
