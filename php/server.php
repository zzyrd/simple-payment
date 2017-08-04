<?php
include_once 'credentials.php';
include_once 'http_cache_killer.php';

//Start session
session_start();
$_SESSION['pay-process'] = false;
//Respond with JSON content
header('Content-Type: application/json');

//get amount of money to charge
$amount = $_SESSION['amount'];

\Stripe\Stripe::setApiKey($st_secret_key);
// Get the payment token submitted by the form:
$token = $_POST['stripeToken'];
try {
  // Charge the user's card:
    $charge = \Stripe\Charge::create(array(
     "amount" => $amount,
     "currency" => "usd",
     "description" => "Example charge",
     "source" => $token,
    ));
    if($charge["status"] == "succeeded"){
        header('Location: ../step-3.php');
        $_SESSION['pay-process'] = true;
    }
    else{
        echo "<h1>Error!!!</h1>";
    }
} catch(\Stripe\Error\Card $e) {
  // Since it's a decline, \Stripe\Error\Card will be caught
  $body = $e->getJsonBody();
  $err  = $body['error'];
  print('Status is:' . $e->getHttpStatus() . "\n");
  print('Type is:' . $err['type'] . "\n");
  print('Code is:' . $err['code'] . "\n");
  // param is '' in this case
  print('Param is:' . $err['param'] . "\n");
  print('Message is:' . $err['message'] . "\n");
} catch (\Stripe\Error\RateLimit $e) {
  // Too many requests made to the API too quickly
  echo "Too many requests made to the API too quickly " . $e;
} catch (\Stripe\Error\InvalidRequest $e) {
  // Invalid parameters were supplied to Stripe's API
  echo "Invalid parameters were supplied to Stripe's API ". $e;
} catch (\Stripe\Error\Authentication $e) {
  // Authentication with Stripe's API failed
  // (maybe you changed API keys recently)
  echo "Authentication with Stripe's API failed ". $e;
} catch (\Stripe\Error\ApiConnection $e) {
  // Network communication with Stripe failed
  echo "Network communication with Stripe failed ". $e;
} catch (\Stripe\Error\Base $e) {
  // Display a very generic error to the user, and maybe send
  // yourself an email
  echo "Base ". $e;
} catch (Exception $e) {
  // Something else happened, completely unrelated to Stripe
  echo $e;
}

//Retrieve last 4 digits
try{
    $card = \Stripe\Token::retrieve($token);
    $_SESSION['l4digits'] = $card["card"]["last4"];

} catch(Exception $e) {
    echo $e;
}

?>