<?php

// STEP 1: Read POST data

// reading posted data from directly from $_POST causes serialization 
// issues with array data in POST
// reading raw POST data from input stream instead. 
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
     $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
   $get_magic_quotes_exists = true;
} 
foreach ($myPost as $key => $value) {        
   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
   } else {
        $value = urlencode($value);
   }
   $req .= "&$key=$value";
}


// STEP 2: Post IPN data back to paypal to validate

$ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr'); // change to [...]sandbox.paypal[...] when using sandbox to test
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

// In wamp like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
// of the certificate as shown below.
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
if( !($res = curl_exec($ch)) ) {
    // error_log("Got " . curl_error($ch) . " when processing IPN data");
    curl_close($ch);
    exit;
}
curl_close($ch);


// STEP 3: Inspect IPN validation result and act accordingly

if (strcmp ($res, "VERIFIED") == 0) {
    // check whether the payment_status is Completed
    // check that txn_id has not been previously processed
    // check that receiver_email is your Primary PayPal email
    // check that payment_amount/payment_currency are correct
    // process payment

    // assign posted variables to local variables
    $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    if ($_POST['mc_gross'] != NULL)
    	$payment_amount = $_POST['mc_gross'];
    else
   		$payment_amount = $_POST['mc_gross1'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];
    $custom = $_POST['custom'];
    
	// Insert your actions here

	$info = 'USER=admin_api1.daricbennett.com'
		.'&PWD=DUU9V32WYX8K33QK'
		.'&SIGNATURE=AGXD3lllfe0isxl6RLXWWkOdqi43A0w0Mv6h0e.2xUiLXwwRLrNGrOPl'
		.'&METHOD=TransactionSearch'
		.'&TRANSACTIONCLASS=RECEIVED'
		.'&EMAIL=' . $receiver_email
		.'&STARTDATE=2018-01-01T05:38:48Z'
		.'&VERSION=94';

	$curl = curl_init('https://api-3t.paypal.com/nvp');
	curl_setopt($curl, CURLOPT_FAILONERROR, true);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	curl_setopt($curl, CURLOPT_POSTFIELDS,  $info);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_POST, 1);

	$result = curl_exec($curl);

# Bust the string up into an array by the ampersand (&)
# You could also use parse_str(), but it would most likely limit out
	$result = explode("&", $result);

	echo "result array : <br>";
	print_r($result);
	echo "<br><br>";

# Loop through the new array and further bust up each element by the equal sign (=)
# and then create a new array with the left side of the equal sign as the key and the right side of the equal sign as the value
	foreach($result as $value){
		$value = explode("=", $value);
		$temp[$value[0]] = $value[1];
	}

# At the time of writing this code, there were 11 different types of responses that were returned for each record
# There may only be 10 records returned, but there will be 110 keys in our array which contain all the different pieces of information for each record
# Now create a 2 dimensional array with all the information for each record together
	for($i=0; $i<count($temp)/11; $i++){
		$returned_array[$i] = array(
			"timestamp"         =>    urldecode($temp["L_TIMESTAMP".$i]),
			"timezone"          =>    urldecode($temp["L_TIMEZONE".$i]),
			"type"              =>    urldecode($temp["L_TYPE".$i]),
			"email"             =>    urldecode($temp["L_EMAIL".$i]),
			"name"              =>    urldecode($temp["L_NAME".$i]),
			"transaction_id"    =>    urldecode($temp["L_TRANSACTIONID".$i]),
			"status"            =>    urldecode($temp["L_STATUS".$i]),
			"amt"               =>    urldecode($temp["L_AMT".$i]),
			"currency_code"     =>    urldecode($temp["L_CURRENCYCODE".$i]),
			"fee_amount"        =>    urldecode($temp["L_FEEAMT".$i]),
			"net_amount"        =>    urldecode($temp["L_NETAMT".$i]));
	}

	echo "returned array : <br>";
	print_r($returned_array);
	echo "<br><br>";

	echo count($returned_array);


} else if (strcmp ($res, "INVALID") == 0) {
    // log for manual investigation
}
?>