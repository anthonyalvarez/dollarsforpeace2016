<?php

require_once './lib/Braintree.php';
// Place your API keys & environment variable here

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('5q3mpq4bkch8mc73');
Braintree_Configuration::publicKey('9qpqb67kb366pqbh');
Braintree_Configuration::privateKey('f9a7e1fb0e47f0138c56be2e47b3aca3');


//  We're generating the client token here on the client side, however, you can certainly generate this
//  server side and pass it to your client if you'd prefer.

$clientToken = Braintree_ClientToken::generate();

?>

<html>
  <head>
    <title>Simple Drop-In Client</title>
  </head>
<body>
  <form id="checkout" method="post" action="server.php">
    <div id="payment-form"></div>
    <input type="submit" value="Pay!">
    
    <!-- This hidden field is simply sending an amount to the server, to be used in the transaction
          You can choose to pass this amount to your server in a preset value, or let the customer input
          whatever value they'd like (after you validate it is a valid amount of course) -->
    <input type="hidden" name="amount" value="10">
  </form>
</body>
<script src="https://js.braintreegateway.com/v2/braintree.js"></script>

  <script>
  braintree.setup("<?php echo($clientToken) ?>",
  // We're just doing a simple client token interpolation, you can of course choose to do this however you'd prefer
  "dropin", {
  container: "payment-form"
  });
  </script>

</html>
