<?php
require '../vendor/autoload.php';
use Twilio\Rest\Client;

function send_sms($numero, $message){
    $account_sid = "ACf0285a65088adc508a6e616ae6aa2388";
    $auth_token = "5579f4189a750c1b354b0371e6cc9c2f";
    $twilio_number = "+17622495772";
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
