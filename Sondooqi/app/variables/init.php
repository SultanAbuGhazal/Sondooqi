<?php

$config_json = file_get_contents('http://localhost/Sondooqi/Sondooqi/app/variables/config.json');
$GLOBALS = json_decode($config_json, true); 

//set timezone
date_default_timezone_set('Asia/Dubai');



require_once 'C:\wamp64\www\Sondooqi\Sondooqi\app\core\App.php';
require_once 'C:\wamp64\www\Sondooqi\Sondooqi\app\core\Controller.php';
require_once 'C:\wamp64\www\Sondooqi\Sondooqi\app\core\Model.php';



