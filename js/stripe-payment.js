var stripe = Stripe('pk_test_8pDzb0r3RZOzk50LPQvf4f60');
var elements = stripe.elements();
    
// Custom styling can be passed to options when creating an Element.
var style = {
  base: {       
        lineHeight: '20px',
        letterSpacing: '2px',
        fontSize: '16px',
        fontSmoothing: 'antialiased',
        '::placeholder': {
            color: '#3c3a3d',
        },
        ':hover': {           
            fontSize: '18px',
            letterSpacing: '3px',
        }
  },
   
};


//Create card number
var cardNumber = elements.create('cardNumber', { iconStyle: 'solid', style: style, placeholder: '____ ____ ____ ____'});
//Create card expiry
var cardExpiry = elements.create('cardExpiry', {style: style, placeholder: '__ / __'});
//Create card CVC
var cardCvc = elements.create('cardCvc', {style: style, placeholder: '___'});
//Create card postal Code
var cardpostalCode = elements.create('postalCode', {style: style, placeholder: '_____'});

// Add an instance of the card Elements into each of the card's <div>
cardNumber.mount('#card-number');
cardExpiry.mount('#card-expiry');
cardCvc.mount('#card-cvc');
cardpostalCode.mount('#card-postalCode');
    
//validate inputs as user typed in fields: cardNumber, cardExpiry, cardCvccard, and postalCode
cardNumber.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-number-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});
cardExpiry.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-expiry-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});
cardCvc.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-cvc-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});
cardpostalCode.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-postalCode-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});
    
    
// Create a token or display an error when the form is submitted.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();
  //Token for cardNumber
//  var form_infor = document.querySelector('form');
  var extraDetails = {
    name: form.querySelector('input[name=cardholder-fname]').value + " " + form.querySelector('input[name=cardholder-lname]').value,
    address_line1: form.querySelector('input[name=address1]').value,
    address_line2: form.querySelector('input[name=address2]').value,
    address_city: form.querySelector('input[name=city]').value,
    address_state: form.querySelector('input[name=state]').value,
    address_country: form.querySelector('input[name=country]').value,
  };

  stripe.createToken(cardNumber, extraDetails).then(function(result) {
    if (result.error) {
     
      var errorElement = document.getElementById('card-number-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server
      stripeTokenHandler(result.token);
    }
  });    
  
});
//submit the token with additional info to the server
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
    
    
