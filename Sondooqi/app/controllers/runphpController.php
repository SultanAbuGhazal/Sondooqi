<?php

class Runphp extends Controller {
	public function defaultMethod(){
        //No default method, get home view
        header("Location: ".$GLOBALS['webhost']['base_url']."/home");
        exit;
    }
}