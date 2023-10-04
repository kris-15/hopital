<?php
require '../vendor/autoload.php';
use Twilio\Rest\Client;

function send_sms($numero, $message){
    $account_sid = "AC85ee1ee7c4fdc943f203b0df502f48ef";
    $auth_token = "9f54b836c8a63fafe1118e9057a5fa02";
    $twilio_number = "+12512415979";
    $client = new Client($account_sid, $auth_token);
    $client->messages->create(
        // Where to send a text message (your cell phone?)
        $numero,
        array(
            'from' => $twilio_number,
            'body' => $message
        )
    );
}
