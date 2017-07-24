<?php

class App{
	private $defaultMethod = 'defaultMethod';
	private $controller = 'home';
	private $method = 'defaultMethod';
	private $params = [];
	
	function __construct(){
        session_start();
		$url = $this->parseURL();
		
		//Include the controller
		if(file_exists('../app/controllers/'.$url[0].'Controller.php')){
			$this->controller = $url[0];
			unset($url[0]);
		}

		//validatAccess will change the variable according to user privilege
		$this->validateAccess($this->controller, $url[1]);

		require_once '../app/controllers/'.$this->controller.'Controller.php';


		//Create an instance of the needed controller
		$this->controller = new $this->controller;

		//Find the needed method, make sure it exists
		//if it does not, the default method (defaultMethod) will be called
		if(isset($url[1])){
			if(method_exists($this->controller, $url[1])){
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		//Set the parameterd
		$this->params[] = $url ? array_values($url) : [];

		//Call the method and pass the parameters
		call_user_func_array([$this->controller, $this->method], $this->params);
	}
	private function parseURL(){
		if(isset($_GET['url'])){
			return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
	private function validateAccess(&$controller, &$method){
		switch($controller){
			case 'admin':
				if($this->userIsAdmin()) return;
				else {header("Location: ".$GLOBALS['webhost']['base_url']."/home"); exit;}
			break;
			case 'file': return; break;
			case 'home': return; break;
			case 'profile': 
				if($this->userIsLoggedIn()) return;
				else {header("Location: ".$GLOBALS['webhost']['base_url']."/home"); exit;}
			break;
			case 'runphp':
				if($this->userIsAdmin()) return;
				else {header("Location: ".$GLOBALS['webhost']['base_url']."/home"); exit;}
			break;
			case 'user': return; break;
		}
	}
	private function userIsAdmin(){
        if(isset($_SESSION['login_type']))
		    return ($_SESSION['login_type'] == "Admin") ? true : false;
        else return false;
	}
	private function userIsLoggedIn(){
		return isset($_SESSION['user_identification']);
	}
}