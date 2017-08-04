<?php
//Start session
session_start();
if(!$_SESSION['pay-process']){
     header('Location: step-1.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment info</title>
  <!--Bootsrap  -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="style.css">
  <!-- Stripe payment api -->
  <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

  <!-- Navbar -->
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">LOGO</a>
        </div>
      </div>
    </nav>

    <div class="row row_MarginB">
        <div class="center title-text-decorated">
            <h4>Payment information</h4>
        </div>
    </div>
    <hr>
    <div class="row row_MarginB">
        <div class="center jumbotron">
            <form action="php/server.php" method="post" id="payment-form">
                
            <div class="center title-text-decorated">
                <h4>Cards information</h4>
            </div>
            <div class="row">
                <div class=" col-lg-6">
                    <div class="form-text-left">
                    <label for="cardType">Credit Card Type:</label>
                    <select name='cardType' id='cardType' class="form-control form-style">
                            <option value="">Choose Type</option>
                            <option value="Visa">Visa</option>
                            <option value="Master">Master</option>
                            <option value="American Express">American Express</option>
                            <option value="Discover">Discover</option>
                    </select>
                    </div>
                </div>

           </div>
            <div class="row">     
                <div class="col-lg-6">
                     <div class="form-text-left">                     
                        <label for="card-number">Credit or debit card</label>
                         <div id="card-number" class="form-control form-style">
                        <!-- a Stripe Element will be inserted here. -->
                         </div>
                         <div id="card-number-errors" role="alert" style="color: red;"></div>
                    </div>
                </div>               
           </div>          
            <div class="row">
                <div class="col-lg-2">
                     <div class="form-text-left">         
                         <label for="card-expiry">Expiration</label>
                         <div id="card-expiry" class="form-control form-style">
                        <!-- a Stripe Element will be inserted here. -->
                         </div>
                         <div id="card-expiry-errors" role="alert" style="color: red;"></div>       
                    </div>
                </div>        
                <div class="col-lg-2">
                     <div class="form-text-left">            
                         <label for="card-cvc">CVC</label>
                         <div id="card-cvc" class="form-control form-style">
                        <!-- a Stripe Element will be inserted here. -->
                         </div>
                         <div id="card-cvc-errors" role="alert" style="color: red;"></div>         
                    </div>
                </div>          
                <div class="col-lg-2">
                     <div class="form-text-left">                    
                         <label for="card-postalCode">ZipCode</label>
                         <div id="card-postalCode" class="form-control form-style">
                        <!-- a Stripe Element will be inserted here. -->
                         </div>
                         <div id="card-postalCode-errors" role="alert" style="color: red;"></div>                    
                    </div>
                </div>
           </div>

            <hr>
            <div class="center title-text-decorated">
                <h4>Billing Address</h4>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="form-text-left">
                        <label for="fname">First Name:</label>
                        <input type="text" id="fname" name="cardholder-fname" class="form-control form-style">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-text-left">
                        <label for="lname">Last Name:</label>
                        <input type="text" id="lname" name="cardholder-lname" class="form-control form-style">
                    </div>
                </div>
           </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-text-left">
                        <label for="address1">Address 1:</label>
                        <input type="text" id="address1" name="address1" class="form-control form-style">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-text-left">
                        <label for="address2">Address 2:</label>
                        <input type="text" id="address2" name="address2" class="form-control form-style">
                    </div>
                </div>
           </div>
            <div class="row">
                <div class="col-lg-2">
                    <div class="form-text-left">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" class="form-control form-style">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-text-left">
                        <label for="state">State:</label>
                        <input type="text" id="state" name="state" class="form-control form-style">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-text-left">
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" class="form-control form-style">
                    </div>
                </div>
           </div>

            <hr>
            <div class="center title-text-decorated">
                <h4>Billing Summary</h4>
            </div>
            <div class="row">
                <div class="col-lg-6">
                      <p>Name: </p>
                </div>
                <div class="col-lg-6">
                      <p class="text-right"><?php echo $_SESSION['biller'];?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                      <p>CC Detail: </p>
                </div>
                <div class="col-lg-6">
                      <p class="text-right">XXXX XXXX XXXX 1234</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                      <p>Bill Amount: </p>
                </div>
                <div class="col-lg-6">
                      <p class="text-right"><?php echo number_format((float)($_SESSION['amount'] / 100), 2, '.', '');?> $</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                      <p>Fee: </p>
                </div>
                <div class="col-lg-6">
                      <p class="text-right">0.00 $</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                      <p>Summary: </p>
                </div>
                <div class="col-lg-6">
                      <p class="text-right"><?php echo number_format((float)($_SESSION['amount'] / 100), 2, '.', '');?> $</p>
                </div>
            </div>

            <br>
            <br>

            <div class="row">
                  <div class="center title-text-decorated">
                    <button type="submit" name="btnsubmit" id="customButton" class="btn btn-default btn-customized">Confirm</button>
                </div>
            </div>            
            <script src="js/stripe-payment.js"></script>

          </form>

        </div>
    </div>


</body>
</html>
