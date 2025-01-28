<?php 
require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('your-secret-key');

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