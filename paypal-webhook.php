<?php
/**
 * Template Name: Paypal WebHook
 *
 * The template for Paypal WebHook.
 *
 *
 * @package boiler
 */

ini_set('display_errors', '1');


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

$ch = curl_init('https://ipnpb.paypal.com/cgi-bin/webscr'); // change to [...]sandbox.paypal[...] when using sandbox to test
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
	$payment_status = $_POST['payment_status'];
	$payment_gross = $_POST['payment_gross'];
	$mc_gross = $_POST['mc_gross'];
	$subscr_payment = $_POST['subscr_payment'];
	$txn_type = $_POST['txn_type'];
	$txn_id = $_POST['txn_id'];
	$receiver_email = $_POST['receiver_email'];
	$payer_email = $_POST['payer_email'];
	$payment_id = $_POST['recurring_payment_id'];

	// Insert your actions here

	//Live
	$info = 'USER=admin_api1.daricbennett.com'
		.'&PWD=DUU9V32WYX8K33QK'
		.'&SIGNATURE=AGXD3lllfe0isxl6RLXWWkOdqi43A0w0Mv6h0e.2xUiLXwwRLrNGrOPl'
		.'&METHOD=TransactionSearch'
		.'&TRANSACTIONCLASS=RECEIVED'
		.'&EMAIL=' . $payer_email
		.'&STARTDATE=2018-01-01T05:38:48Z'
		.'&VERSION=94';

	//Sandbox
	/*$info = 'USER=admin-facilitator_api1.daricbennett.com'
		.'&PWD=Q2X7PST6P4XZWRGR'
		.'&SIGNATURE=AFcWxV21C7fd0v3bYYYRCpSSRl31AjCPiqNDSAqutwZB5VD8Sf5TJUL0'
		.'&METHOD=TransactionSearch'
		.'&TRANSACTIONCLASS=RECEIVED'
		.'&EMAIL=' . $payer_email
		.'&STARTDATE=2018-01-01T05:38:48Z'
		.'&VERSION=94';*/

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

		//echo "result array : <br>";
		//print_r($result);
		//echo "<br><br>";

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

		//echo "returned array : <br>";
		//print_r($returned_array);
		//echo "<br><br>";

		$transCount = count($returned_array);

		if ($transCount > 1 && $mc_gross != "" && $payment_status == "Completed") {

			$paymentAmount = "";

			switch ($mc_gross) {

				case "9.99":
					$paymentAmount = "9.99";
					break;
				case "28.99":
					$paymentAmount = "28.99";
					break;
				case "54.99":
					$paymentAmount = "54.99";
					break;
				case "99.99":
					$paymentAmount = "99.99";
					break;
				default:
					$paymentAmount = "none";
					break;
			}

			global $wpdb;
			$results = $wpdb->get_results("SELECT * FROM `a02_click_id` WHERE `recurringid` = '$payment_id'");
			if (count($results) > 0) {
				$clickID = $results[0]->clickid;
			} else {
				$clickID = "";
			}
			$wpdb->flush();

			if ($clickID != "") {

				$params = array(
					"uid"     => "drbt",
					"clickid" => $clickID
				);

				$fields_string = array();

				foreach ( $params as $key => $value ) {
					$fields_string .= $key . '=' . urlencode( $value ) . '&';
				}

				rtrim( $fields_string, '&' );

				//open connection
				$ch = curl_init();

				//set the url, number of POST vars, POST data
				curl_setopt( $ch, CURLOPT_URL, $url );
				//curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
				//curl_setopt($ch,CURLOPT_HEADER, false);
				curl_setopt( $ch, CURLOPT_POST, count( $fields_string ) );
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields_string );

				//execute post
				$result = curl_exec( $ch );

				//close connection
				curl_close( $ch );

				$postback = "http://affiliate.daricbennett.com/?uid=drbt&clickid=" . $clickID;

				$to      = "mcirami@gmail.com";
				$headers = array( 'Content-Type: text/html; charset=UTF-8' );
				$subject = "Triggered function from paypal-webhook sandbox";
				$body    = "Transaction Count 2 AND Payment " . $paymentAmount .
				           "<br><br> AND Payment Status Completed" .
				           "<br><br>Payment Gross: " . $payment_gross .
				           "<br><br> MC Gross: " . $mc_gross .
				           "<br><br> payer email: " . $payer_email .
				           "<br><br> Payment Status: " . $payment_status .
				           "<br><br> Subscr Payment: " . $subscr_payment .
				           "<br><br> txn_type: " . $txn_type .
				           "<br><br> Txn ID: " . $txn_id .
				           "<br><br> Receiver Email: " . $receiver_email .
				           "<br><br> Transaction Count: " . $transCount .
				           "<br><br> Postback URL: " . $postback .
				           "<br><br> Payment ID: " . $payment_id;

				wp_mail( $to, $subject, $body, $headers );
			}
		}

} else if (strcmp ($res, "INVALID") == 0) {


	$to = "mcirami@gmail.com";
	$headers = array('Content-Type: text/html; charset=UTF-8');
	$subject = "Triggered function from LIVE paypal-webhook";
	$body = "invalid if statement: <br><br>" . $res;

	wp_mail($to, $subject, $body, $headers);
}
?>
