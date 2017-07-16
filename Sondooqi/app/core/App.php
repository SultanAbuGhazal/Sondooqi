<?php

class App{
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
		$this->controller = $this->validateAccess($this->controller);
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
	private function validateAccess($controller){
		return $controller;
	}
}