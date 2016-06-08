<?php

require_once 'lib/Braintree.php';
// Place your API keys & environment variable here

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('your_merchant_ID');
Braintree_Configuration::publicKey('your_public_key');
Braintree_Configuration::privateKey('your_private_key');



//  Here we're pulling values from the post from our form, and assigning them to variables to be used in our transaction

$nonce = $_POST["payment_method_nonce"];
$amount = $_POST["amount"];


//  Here we're using the variables in our very basic transaction, with the submit for settlement to begin the capture of funds
//  if the transaction is successful

$result = Braintree_Transaction::sale([
  'amount' => $amount,
  'paymentMethodNonce' => $nonce,
  'options' => [
    'submitForSettlement' => True
  ]
]);


//  Here we have some very basic result handling that will log either the successful transaction id, or the errors
//  encountered when the server page is loaded successfully.  Again, you can customize the behavior, and simply pass
//  in the form POST, then redirect to another page upon a successful transaction if you'd prefer.  This example is simply
//  to provide a general example.

if ($result->success) {
    print_r("success!: " . $result->transaction->id);
} else if ($result->transaction) {
    print_r("Error processing transaction:");
    print_r("\n  code: " . $result->transaction->processorResponseCode);
    print_r("\n  text: " . $result->transaction->processorResponseText);
    print_r("\n  status: " . $result->transaction->status);
    print_r("\n  reason: " . $result->transaction->gatewayRejectionReason);
} else {
    print_r("Validation errors: \n");
    print_r($result->errors->deepAll());
}
?>