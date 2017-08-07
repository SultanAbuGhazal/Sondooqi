<?php

class Runphp extends Controller {
	public function defaultMethod(){
        /*
        return;
        $url = 'https://rest.nexmo.com/sms/json';
        $data = array(
                'from' => 'Sondooqi',
                'text' => utf8_encode('تجربة عربي '),
                'to' => '971554895784',
                'api_key' => 'ffcac206',
                'api_secret' => 'ea4de7f43bca523f',
                'type' => 'unicode'
                );
        echo "<br><br>";
        print_r($data);

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { echo "error"; }

        echo "<br><br>";
        var_dump($result);
        echo time();
        

        //var_dump(openssl_get_cert_locations());
        $curl = curl_init();
        
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://rest.nexmo.com/sms/json',
            CURLOPT_USERAGENT => 'Sondooqi SMS Request',
            CURLOPT_POST => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERPWD => "ales.kallisitos@gmail.com:Sultn_1996",
            CURLOPT_POSTFIELDS => [
                'from' => 'Sondooqi',
                'text' => '2nd Test SMS from Sondooqi.com - تجربة',
                'to' => '971554895784',
                'api_key' => 'ffcac206',
                'api_secret' => 'ea4de7f43bca523f'
            ]
        ));


        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        print_r($resp);

        // Close request to clear up some resources
        curl_close($curl);
        return;
        require_once "../vendor/autoload.php";
        $credentials = new Nexmo\Client\Credentials\Basic('ffcac206', 'ea4de7f43bca523f');
        $client = new Nexmo\Client($credentials);

        $message = $client->message()->send([
        'from' => 'Sondooqi.com',
        'to' => '971554895784',
        'text' => "Test SMS from Sondooqi.com - تجربة "
        ]);

        echo "<br><br>";
        echo "Sent message to " . $message['to'] . ". Balance is now " . $message['remaining-balance'] . PHP_EOL;
        echo "<br><br><br><br>";
        print_r($message);
        

        */

    }
}