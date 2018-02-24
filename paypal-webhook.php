<?php
/**
 * Template Name: Paypal WebHook
 *
 * The template for Paypal WebHook.
 *
 *
 * @package boiler
 */

require 'vendor/autoload.php';


$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AeFW2LLDHPa3eiba6vsgwcM9DOp8bt5pYb0w1mSARNfx7yc-fPI-n10ve4-o1UQzaRvVrJTIdEpICG8P',
        'EDPd_lEAsVvJS_SyKChVFIa6G1VHKyRsrdnv--OGgHthRYvGAq_hQWJ53kSm2O1vqTVc9rfSvGuZDN-3'
    )
);
/*
$webhook = new \PayPal\Api\Webhook();

// Set webhook notification URL
$webhook->setUrl("https://f615ef32.ngrok.io");

// Set webhooks to subscribe to
$webhookEventTypes = array();
$webhookEventTypes[] = new \PayPal\Api\WebhookEventType(
    '{
"name":"PAYMENT.SALE.COMPLETED"
}'
);

$webhook->setEventTypes($webhookEventTypes);*/


$webhookEvent = new \PayPal\Api\WebhookEvent();

$event = $webhookEvent->getEventType();

if ($event == 'PAYMENT.SALE.COMPLETED') {
    $my_file = fopen('event.txt', 'w') or die('Cannot open file:  '.$my_file);
    $data = "event triggered";
    fwrite($my_file, $data);
    fclose($my_file);

    $to = "mcirami@gmail.com";
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $subject = "Paypal Sale";
    $body = "Triggered paypal actions";

    wp_mail($to, $subject, $body, $headers);

}

/*
try {

    $output = $webhook->create($apiContext);


} catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode();
    echo $ex->getData();
    die($ex);
} catch (Exception $ex) {
    die($ex);
}

if ($_POST['payment_status'] == "Completed") {

    $to = "mcirami@gmail.com";
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $subject = "Paypal Sale";
    $body = "Triggered paypal actions";

    wp_mail($to, $subject, $body, $headers);

}*/




/*
if ( $_POST['payment_status'] == "Completed" ) {
    $last_subscr_order = new MemberOrder();

    pmpro_ipnSaveOrder( $txn_id, $last_subscr_order );

    $user_id                = $last_subscr_order->user_id;
    $user                   = get_userdata( $user_id );
    $user->membership_level = pmpro_getMembershipLevelForUser( $user_id );

    if ($user->membership_level != "" || $user->membership_level != null) {
        $membershipLevel = $user->membership_level;
    } else {
        $membershipLevel = "";
    }

    $to = "mcirami@gmail.com";
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $subject = "PayPal Payment";
    $body = "Triggered PayPal Payment" . $membershipLevel;

    wp_mail( $to, $subject, $body, $headers );

}*/

