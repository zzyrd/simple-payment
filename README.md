# Introduction:
 The project is using Stripe api to build up an simple online payment system with security insured.

# Notice:

 In real business, all transactions should be under HTTPS protocol. (I did testing under HTTP)

 My Stripe Account monitor all activities such as creating token, making charges, failure notification, etc.

# How it works:
The third party payment API I used is Stripe.
* When webpage load, stripe-payment.js file, which I wrote, will create the secure card input fields for user to type in their card. Meanwhile, it also do error checking.
* When user finish filling in form and click confirm button, the Server will charge certain money for the card and send out message
* if success, redirect to successful page; otherwise, show error messages.

By going  through the whole process, server cannot get any information of Card Credentials. the
only thing the  server obtain is a token from Stripe, which is used for charging money, and more usages.
Security is guaranteed.

# How to use:

1. Place the payment folder under your 'localhost' folder or Server.
    * For mac users, more details how to set up localhost on this [site](https://coolestguidesontheplanet.com/get-apache-mysql-php-and-phpmyadmin-working-on-osx-10-11-el-capitan/)
    * For windows users, more details how to set up localhost on this [Video](https://www.youtube.com/watch?v=6LjpyHoXVjo)


2. Open the step-1.html to begin.

3. Please Don't use real Credit Card or Debit Card to do Testing!!!!! This is only under test mondel in Stripe. The real card will cause issues and not secure for yourself.
       Using the following card Number to test:

       4242 4242 4242 4242

4. Session variables $_SESSION['pay-process'] is used for purpose, which enforcing user from very first step going through the final step.


5. When payment succeed, you will only have 10 min to send out message. Otherwise, You won't get any information from email even through you will still get email.

6. image upload is not fully working; however it won't affect the whole workflow. It's kind of hard to deal with files using php. I didn't want to put so much time on it.

7. In the step-2 page, I cannot change the CC detail of Billing summary section because we just typed in the card number, it’s impossible to show encrypted card info without clicking the Button.
