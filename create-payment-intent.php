<?php 
require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_51QmDvQQKXhrTFb70dBIipdkE9qCXSYzeMyFPULq8IYANIP4jexRVFFUqruxEhRnbZx92zRciH7B3SnwuZDNE6H1f000LbCJBYa');

//Get the payment amount from the frontend
$paymentAmount=$_POST['amount'];

try{
    //create payment intent
    $paymentIntent=\Stripe\PaymentIntent::create([
        'amount'=>$paymentAmount,//cents
        'currency'=>'lkr',

    ]);

    //send client secret to the frontend
    echo json_encode(['clientSecret'=>$paymentIntent->client_secret]);
}catch(Exception $e){
    //Handle error
    echo json_encode(['error'=>$e->getMessage()]);
} 

?>