<?php

class Runphp extends Controller {
	public function defaultMethod(){
        echo realpath("");
        return;
        require_once 'vendor\autoload.php';
        $credentials = new Nexmo\Client\Credentials\Basic('ffcac206', 'ea4de7f43bca523f');
        $client = new Nexmo\Client($credentials);
        print_r($client);
        
        /*
        $message = $client->message()->send([
        'from' => 'Nexmo',
        'to' => 'NUMBER_TO',
        'text' => 'A text message sent using the Nexmo SMS API'
        ]);
        echo "Sent message to " . $message['to'] . ". Balance is now " . $message['remaining-balance'] . PHP_EOL;
        */
        echo "Hello World!";
    }
}