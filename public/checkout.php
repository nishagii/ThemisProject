<?php
require '../vendor/autoload.php';
require '../core/config.php';
require '../app/controllers/PaymentController.php';

$paymentContrller = new PaymentController();
$paymentController->createCheckoutSession();
