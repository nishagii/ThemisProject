<?php
require '../vendor/autoload.php';
require '../core/config.php';
require '../app/models/PaymentModel.php';

\Stripe\Stripe::setApiKey(STRIPE_SECRET);

$session_id = $_GET['session_id'];
$session = \Stripe\Checkout\Session::retrieve($session_id);

$paymentModel = new PaymentModel();
$paymentModel->savePayment($session->customer_email, $session->amount_total / 100, 'success', $session->id);

echo "Payment Successful!";
