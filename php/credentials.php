<?php

// Send startup errors to stdout(1) vs stderr (0)
ini_set('display_startup_errors', 1);
// Send runtime errors to stdout(1) vs stderr (0)
ini_set("display_errors", 1);
// PHP levels of error reporting
error_reporting(E_ALL);

// Stripe API keys
$st_secret_key = "sk_test_H0zqAvtTqpS8HhYpV5MM2GRv";
$st_public_key = "pk_test_8pDzb0r3RZOzk50LPQvf4f60";

// File path to the Strip library
$path_to_stripe_lib = dirname(__FILE__) . '../../stripe-php-5.1.1/';

include_once($path_to_stripe_lib . 'init.php');

?>