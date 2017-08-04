<?php
//Start session
session_start();
if(!$_SESSION['pay-process']){
     header('Location: step-1.html');
}
$_SESSION['timeout'] = time();
// session timed out after 10 min
if ($_SESSION['timeout'] + 10 * 60 < time()) {     
      $_SESSION['pay-process'] = false;
    // remove all session variables
    session_unset(); 
    // destroy the session 
    session_destroy();
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
        <div class="center jumbotron">
            <div class="center title-text-decorated">
                <h4>Success!</h4>
            </div>
            <hr>
            <div class="center title-text-decorated">
                <h5>Recipt</h5>
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
                      <p class="text-right">XXXX XXXX XXXX <?php echo $_SESSION['l4digits'];?></p>
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
            <div class="center title-text-decorated">
                <h6>Enter an email address if you want a digital receipt</h6>
            </div>
            
            <div class="row">
                <form action="php/send-email.php" method="post" >
                <div class="col-lg-8">
                    <div class="form-text-left email-input">
                    <input type="email" id="email" name="email" class="form-control form-style" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                    </div>    
                </div>
                <div class="col-lg-2 email-button">    
                    <button type="submit" name="submit" class="btn btn-default" onclick="myFucntion()">send</button>
                </div>
                </form>
                
                <script>
                
                function myFucntion() {
                    var x = document.getElementById("email").name;
                    console.log(x)
                }
                
                </script>
                
                
           </div>
            
        </div>      
    </div>


</body>
</html>