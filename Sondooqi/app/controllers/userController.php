<?php

class User extends Controller {
    /*No error handeling for user mobile confirmation*/
    public function login(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $mobileIsConfirmed = true;
            $goto = $GLOBALS['webhost']['base_url']."/home";
            $userModel = $this->model('UserModel');

            /*Validate user*/
            $userInfo = $userModel->userIsValid($_POST['user_email']);
            if($userModel->errorsExist()){
                $this->errors[] = "!البريد الإلكتروني وكلمة السر خطأ";
                if($GLOBALS['developerMode']){
                    $this->errors[] = "User validation failed!";
                    $this->errors = array_merge($this->errors, $userModel->getErrors());
                }
            }

            /*Check account status*/
            if(empty($this->errors)){
                if($userModel->mobileIsNotConfirmed($_POST['user_email'])){
                    $mobileIsConfirmed = false;
                    $goto = $GLOBALS['webhost']['base_url']."/user/confirm";
                }elseif($userModel->loginIsNotAllowed($_POST['user_email'])){
                    $this->errors[] = "!للأسف، لا يسمح لك بتسجيل الدخول";
                }

                if($userModel->errorsExist()){
                    $this->errors[] = "!لم ينجح تسجيل الدخول";
                    if($GLOBALS['developerMode']){
                        $this->errors[] = "Account failure!";
                        $this->errors = array_merge($this->errors, $userModel->getErrors());
                    }
                }
            }

            /*Authenticate user*/
            if(empty($this->errors)){
                if(!$userModel->userIsAuthentic($userInfo['id'], $_POST['user_email'], $_POST['user_pass'])){
                    $this->errors[] = "!البريد الإلكتروني وكلمة السر خطأ";
                }
                if($userModel->errorsExist()){
                    $this->errors[] = "!لم ينجح تسجيل الدخول";
                    if($GLOBALS['developerMode']){
                        $this->errors[] = "Authentication Failed!";
                        $this->errors = array_merge($this->errors, $userModel->getErrors());
                    }
                }
            }

            /*Get user privilege*/
            if(empty($this->errors)){
                $login_type = $userModel->getUserPrivilege($userInfo['id']);
                if($userModel->errorsExist()){
                    $this->errors[] = "!لم ينجح تسجيل الدخول";
                    if($GLOBALS['developerMode']){
                        $this->errors[] = "Authentication Failed!";
                        $this->errors = array_merge($this->errors, $userModel->getErrors());
                    }
                }
            }
            
		    header('Content-Type: application/json; charset=utf-8');
            if(empty($this->errors)){
                if($mobileIsConfirmed){
                    if($login_type->admin_login == "0"){
                        $this->loginUser($userInfo['id'], $userInfo['name'], "User");
                    }elseif($login_type->admin_login == "1"){
                        $this->loginUser($userInfo['id'], $userInfo['name'], "Admin");
                    }
                }else{
                    $_SESSION['unconfirmed_user_id'] = $userInfo['id'];
                    $_SESSION['unconfirmed_user_name'] = $userInfo['name'];
                    $_SESSION['unconfirmed_user_mobile'] = $userInfo['mobile'];
                }  
                echo json_encode(['goto' => $goto]);
                header("HTTP/1.1 200 OK");
            }else{
                echo json_encode(['errors' => $this->errors]);
                header("HTTP/1.1 400 Bad Request");
            }
        }
    }
    public function logout(){
        $this->logoutUser();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['goto' => $GLOBALS['webhost']['base_url']."/home"]);
        header("HTTP/1.1 200 OK");
    }
	public function register(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $userModel = $this->model('UserModel');
            $goto = $GLOBALS['webhost']['base_url']."/user/confirm";

            /*Check email and phone number uniqueness*/
            if($userModel->emailIsUsed($_POST['user_email'])){
                $this->errors[] = "!هذا البريد الإكتروني مستخدم";
            }
            if($userModel->mobileIsUsed($_POST['user_mobile'])){
                $this->errors[] = "!رقم الجوال هذا مستخدم";
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
                    "الضفة الغربية",
                    "فلسطين"
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
                        $this->errors = array_merge($this->errors, $userModel->getErrors());
                    }
                }
            }

            /*Create Box*/
            if(empty($this->errors)){
                $boxModel = $this->model('BoxModel');
                $box_id = $boxModel->createNewBox($result['id'], $result['name'], "United Arab Emirates", 99);

                if($boxModel->errorsExist()){
                    $this->errors[] = "!لم ينجح التسجيل";
                    if($GLOBALS['developerMode']){
                        $this->errors[] = "Box creation failed!";
                        $this->errors = array_merge($this->errors, $boxModel->getErrors());
                    }
                    $userModel->deleteUserEntry($result['id']);
                }
            }    

            /*Send confirmation SMS*/
            $this->sendUserConfirmationCode();

            /*Go to confirmation page*/
		    header('Content-Type: application/json; charset=utf-8');
            if(empty($this->errors)){
                //$this->loginUser($result['id'], $result['name'], "User");
                $_SESSION['unconfirmed_user_id'] = $result['id'];
                $_SESSION['unconfirmed_user_name'] = $result['name'];

                echo json_encode(['goto' => $goto]);
                header("HTTP/1.1 200 OK");
            }else{
                echo json_encode(['errors' => $this->errors]);
                header("HTTP/1.1 400 Bad Request");
            }
        }
    }
    public function confirm(){
        $data = ['mobile' => "<br>"];
        if(isset($_SESSION['unconfirmed_user_mobile']))
            $data = ['mobile' => $_SESSION['unconfirmed_user_mobile']];

        // require in the view
        $this->view('confirm/confirm', $data);
    }
    public function confirmUser(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){    
            $goto = "";
            $userModel = $this->model('UserModel');
            $code = $userModel->getUserConfirmationCode($_SESSION['unconfirmed_user_id']);
            
            if($_POST['confirm-code'] == $code){
                $userModel->confirmUser($_SESSION['unconfirmed_user_id']);
                if($userModel->errorsExist()){
                    $this->errors[] = "!لم ينجح التأكيد";
                } else {
                    $this->loginUser(
                        $_SESSION['unconfirmed_user_id'], 
                        $_SESSION['unconfirmed_user_name'], 
                        "User"
                    );
                    $goto = $GLOBALS['webhost']['base_url']."/home";
                }

            }else $this->errors[] = "!رقم التأكيد غير صحيح";

		    header('Content-Type: application/json; charset=utf-8');
            if(empty($this->errors)){
                echo json_encode(['goto' => $goto]);
                header("HTTP/1.1 200 OK");
            }else{
                echo json_encode(['errors' => $this->errors]);
                header("HTTP/1.1 400 Bad Request");
            }
        }
    }
    function resend_code(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->sendUserConfirmationCode();
        }
    }
    private function sendUserConfirmationCode(){
        if($this->userIsLoggedIn()){
            $userModel = $this->model('UserModel');
            $code = $userModel->getUserConfirmationCode($_SESSION['user_identification']);
            $mobile = $userModel->getUserMobile($_SESSION['user_identification']);

            $SMSservice = $this->service('sms');
            $SMSservice->sendConfirmationCode($mobile, $code);
        }
    }
    private function logoutUser(){
        //Unset and Destroy
        $_SESSION = array();
        session_destroy();
    }
    private function loginTempUser(){

    }
    private function loginUser($userid, $name, $type){
        $_SESSION['user_identification'] = $userid;
        $_SESSION['user_name'] = $name;
        $_SESSION['login_time'] = time();
        $_SESSION['login_type'] = $type;        
    }
}