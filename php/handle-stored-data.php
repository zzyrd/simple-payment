<?php

//Start session
session_start();
$_SESSION['pay-process'] = false;

if(isset($_POST['submit'])){
    //didn't handle the image files since not found a good way to do so.
    $name = $_POST['biller'];
    $account = $_POST['account'];
    $amount = $_POST['amount'];

    //get amount value to pass.
    $num = number_format((float)$amount, 2, '.', '') * 100;
    $num = intval($num);
    
    //data needed to pass
    $_SESSION['biller'] = $name;
    $_SESSION['account'] = $account;
    $_SESSION['amount'] = $num;
    
    header('Location: ../step-2.php');
    $_SESSION['pay-process'] = true;
}


?>