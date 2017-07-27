<?php

class Runphp extends Controller {
	public function defaultMethod(){
        return;
            $userModel = $this->model('UserModel');
            $userModel->changeUserPassword($_SESSION['user_identification'], "12345", "1234");
            print_r($userModel->getErrors());
        //No default method, get home view
        header("Location: ".$GLOBALS['webhost']['base_url']."/home");
        exit;
    }
}