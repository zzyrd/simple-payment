<?php
//Start session
session_start();
if(!$_SESSION['pay-process']){
    // remove all session variables
    session_unset(); 
    // destroy the session 
    session_destroy();
    
    echo "Exceed 10 mins! You cannot have a email copy\n";
}
else{

// the message
$name = $_SESSION['biller'];
$card = "xxxx xxxx xxxx " . $_SESSION['l4digits'];
$amount = number_format((float)($_SESSION['amount'] / 100), 2, '.', '');
$amount = floatval($amount);
$fee = 0.00;
$total = $amount + $fee;
$content = "\nFollowing is the details of your bill: \n\nCC Detail:     {$card}\nBill Amount:      {$amount} \$\nFee:     {$fee} \$\n-------------------------------\nTotal: {$total} \$\n";
$ending = "\nThank you for your business!\n\nSincerely,\nCompany name\n";
$msg = "Hello " . $name . $content . $ending;


if (isset( $_POST['submit'])){
    $addr = $_POST['email'];
 
}
// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail($addr,"Your Receipt",$msg);

echo "Success!\n";

// remove all session variables
session_unset(); 
// destroy the session 
session_destroy();


}



?>