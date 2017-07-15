<?php

class User extends Controller {
	public function defaultMethod(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){  
            $continue = true;

            //This does nothing currently
            $this->validateForm($_POST);

            //If there are errors from the validation
            if(!empty($this->errors)) $continue = false;
            
            /*
            Validate the user (Check if the email exists in the database)
            If the user is valid, userInfo will contain the user ID, fname, and lname
            */
            if($continue){
                $userModel = $this->model('UserModel');
                $userInfo = $userModel->validateUser($_POST['emailTxtBx']);
                if($userModel->errorsExist()){
                    $this->errors[] = "Wrong Email or Password!";
                    $continue = false;
                }
            }

            /*
            Check the account status.
            login may not be allowed for one of two reasons:
            (1) User is suspended/banned
            (2) Email is not confirmed (not implemented currently)
            */
            if($continue){
                if(!$userModel->loginIsAllowed($_POST['emailTxtBx'])){
                    if(!$userModel->emailIsConfirmed($_POST['emailTxtBx'])){
                        //Email not confirmed
                        $continue = false;
                    } else {
                        $this->errors[] = "You are not allowed to log in!";
                        $continue = false;
                    }
                }
            } 

            //Authenticate the user (verify the password)
            if($continue){
                $success = $userModel->authenticateUser($userInfo->usrid, $_POST['emailTxtBx'], $_POST['passTxtBx']);
                if(!$success) {
                    $this->errors[] = "Wrong Email or Password!";
                    $continue = false;
                }
            }

            //Get the user access type: Consumer/Provider
            if($continue){
                $userPrivileges = $userModel->getUserPrivilege($userInfo->usrid);
                if($userModel->errorsExist()){
                    $this->errors[] = "Login Failed";
                    $continue = false;
                }
            }

            //If no errors, login is success. Set session variables
            if($continue){
                $_SESSION['user_id'] = $userInfo->usrid;
                $_SESSION['user_name'] = $userInfo->fname . " " . $userInfo->lname;
                $_SESSION['login_time'] = time();
                $_SESSION['consumer_login'] = ($userPrivileges->consumer_login === "1") ? true : false;
                $_SESSION['provider_login'] = ($userPrivileges->provider_login === "1") ? true : false;

                //if the user is consumer, redirect to the profile page
                if($_SESSION['consumer_login'] && !$_SESSION['provider_login']){
                    //header("Location: ".$GLOBALS['webhost']['base_url']."/profile");
                }

                /*
                if the user is provider, get the service ID through the ServiceModel
                save it in a session variable then redirect to the dashboard
                */
                if(!$_SESSION['consumer_login'] && $_SESSION['provider_login']){
                    $serviceModel = $this->model('ServiceModel');
                    $_SESSION['service_id'] = $serviceModel->getServiceID($_SESSION['user_id']);
                    //header("Location: ".$GLOBALS['webhost']['base_url']."/service/dashboard");
                }
            }
        }
        
        //Propagate model errors if developer mode is on
        if($GLOBALS['developerMode'])
            if(isset($userModel))
                $this->errors = array_merge($this->errors, $userModel->getErrors());
        
        //Get the login view, no data is passed but there might be errors to view
        $dummyData = [];
        $this->view('login/login', $dummyData, $this->errors);
    }
    public function login(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        }
    }
	public function register(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $userModel = $this->model('UserModel');

            /*Check email and phone number uniqueness*/
            if($userModel->emailIsUsed($_POST['user_email'])){
                $errors[] = "!هذا البريد الإكتروني مستخدم";
            }
            if($userModel->mobileIsUsed($_POST['user_email'])){
                $errors[] = "!رقم الجوال هذا مستخدم";
            }
            
            /*Insert Address*/
            if(empty($this->errors)){
                $addressModel = $this->model('AddressModel');
                $address_id = $addressModel->insertAddress(
                    $_POST['user_name'], 
                    $_POST['user_mobile'], 
                    $_POST['user_address'], 
                    $_POST['user_nearby'], 
                    $_POST['user_city'], 
                    "West Bank",
                    "Palestine"
                );

                if($addressModel->errorsExist()){
                    $this->errors[] = "!لم ينجح التسجيل";
                    if($GLOBALS['developerMode']){
                        $this->errors[] = "Address insertion failed!";
                        $this->errors = array_merge($this->errors, $addressModel->getErrors());
                    }
                }
            }

            /*Create user*/            
            if(empty($this->errors)){
                $result = $userModel->createNewUser(
                    $address_id,
                    $_POST['user_name'],
                    $_POST['user_pass'],
                    $_POST['user_email'],
                    $_POST['user_mobile']
                );

                if($userModel->errorsExist()){
                    $this->errors[] = "!لم ينجح التسجيل";
                    if($GLOBALS['developerMode']){
                        $this->errors[] = "User creation failed!";
                        $this->errors = array_merge($this->errors, $addressModel->getErrors());
                    }
                }
            }

            /*Send confirmation SMS*/
            //$SMSservice = $this->service('sms');
            //$SMSservice->sendConfirmationCode($mobile, $result['code']);

            /*Login*/
            if(empty($this->errors)){
                $_SESSION['user_identification'] = $result['id'];
                $_SESSION['user_name'] = $result['name'];
                $_SESSION['login_time'] = time();
                $_SESSION['login_type'] = "User";

                header("HTTP/1.1 200 OK");
            }else{
                echo json_encode($this->errors);
		        header('Content-Type: application/json; charset=utf-8');
                header("HTTP/1.1 400 Bad Request");
            }
        }
    }
    public function logout(){
        //Unset and Destroy
        $_SESSION = array();
        session_destroy();
        header("HTTP/1.1 200 OK");
    }
    private function loginUser($userid){
        
    }
    private function validateForm(&$var){
        //Should make the &_POST variables safe
    }
}