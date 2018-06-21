<?php

ini_set('display_errors', '1');

$payer_email = "admin-buyer@daricbennett.com";

	//Live
	/*$info = 'USER=admin_api1.daricbennett.com'
		.'&PWD=DUU9V32WYX8K33QK'
		.'&SIGNATURE=AGXD3lllfe0isxl6RLXWWkOdqi43A0w0Mv6h0e.2xUiLXwwRLrNGrOPl'
		.'&METHOD=TransactionSearch'
		.'&TRANSACTIONCLASS=RECEIVED'
		.'&EMAIL=' . $payer_email
		.'&STARTDATE=2018-01-01T05:38:48Z'
		.'&VERSION=94';*/

	//Sandbox
	$info = 'USER=admin-facilitator_api1.daricbennett.com'
		. '&PWD=Q2X7PST6P4XZWRGR'
		. '&SIGNATURE=AFcWxV21C7fd0v3bYYYRCpSSRl31AjCPiqNDSAqutwZB5VD8Sf5TJUL0'
		. '&METHOD=TransactionSearch'
		. '&TRANSACTIONCLASS=RECEIVED'
		. '&EMAIL=' . $payer_email
		. '&STARTDATE=2018-05-01T05:38:48Z'
		. '&VERSION=94';

	$curl = curl_init('https://api-3t.sandbox.paypal.com/nvp');
	curl_setopt($curl, CURLOPT_FAILONERROR, true);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_POST, 1);

	$result = curl_exec($curl);

	# Bust the string up into an array by the ampersand (&)
	# You could also use parse_str(), but it would most likely limit out
	$result = explode("&", $result);

	/*echo "result array : <br>";
	echo print_r($result);
	echo "<br><br>";*/

	# Loop through the new array and further bust up each element by the equal sign (=)
	# and then create a new array with the left side of the equal sign as the key and the right side of the equal sign as the value
	foreach ($result as $value) {
		$value = explode("=", $value);
		$temp[$value[0]] = $value[1];
	}

	# At the time of writing this code, there were 11 different types of responses that were returned for each record
	# There may only be 10 records returned, but there will be 110 keys in our array which contain all the different pieces of information for each record
	# Now create a 2 dimensional array with all the information for each record together
	for ($i = 0; $i < count($temp) / 11; $i++) {
		$returned_array[$i] = array(
			"timestamp" => urldecode($temp["L_TIMESTAMP" . $i]),
			"timezone" => urldecode($temp["L_TIMEZONE" . $i]),
			"type" => urldecode($temp["L_TYPE" . $i]),
			"email" => urldecode($temp["L_EMAIL" . $i]),
			"name" => urldecode($temp["L_NAME" . $i]),
			"transaction_id" => urldecode($temp["L_TRANSACTIONID" . $i]),
			"status" => urldecode($temp["L_STATUS" . $i]),
			"amt" => urldecode($temp["L_AMT" . $i]),
			"currency_code" => urldecode($temp["L_CURRENCYCODE" . $i]),
			"fee_amount" => urldecode($temp["L_FEEAMT" . $i]),
			"net_amount" => urldecode($temp["L_NETAMT" . $i])
		);
	}

	echo "returned array : <br>";
	print_r($returned_array);
	echo "<br><br>";

	$transCount = count($returned_array);

	echo $transCount;

	/*$to = "mcirami@gmail.com";
	$headers = array('Content-Type: text/html; charset=UTF-8');
	$subject = "Triggered function from paypal-webhook";
	$body = "<br><br> Transaction Count: " . $transCount;

	wp_mail($to, $subject, $body, $headers);*/


?>