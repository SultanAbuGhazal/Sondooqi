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

		//validatAccess will change the variable according to user privilege
		//$validated = $this->validateAccess($this->controller, $this->method);

		//Call the method and pass the parameters
		call_user_func_array([$this->controller, $this->method], $this->params);
	}
	private function parseURL(){
		if(isset($_GET['url'])){
			return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
	private function validateAccess($controller, $method){
		switch($controller){
			case 'admin':
				if($this->userIsAdmin()) return ['cont' => $controller, 'meth' => $method];
				else return ['cont' => 'home', 'meth' => $this->defaultMethod];
			break;
			case 'home': 
			break;
			case 'profile': 
			 	if($this->userIsLoggedIn()) return ['cont' => $controller, 'meth' => $method];
				else return ['cont' => 'home', 'meth' => $this->defaultMethod];
			break;
			case 'user': 
			break;
		}
		return ['cont' => $controller, 'meth' => $method];
	}
	private function userIsAdmin(){
		return ($_SESSION['login_type'] == "Admin") ? true : false;
	}
	private function userIsLoggedIn(){
		return isset($_SESSION['user_identification']);
	}
}