<?php

class User extends Controller {
    public function login(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $goto = $GLOBALS['webhost']['base_url']."/home/about";
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
                if($userModel->loginIsNotAllowed($_POST['user_email'])){
                    $this->errors[] = "!للأسف، لا يسمح لك بتسجيل الدخول";
                    if($userModel->mobileIsNotConfirmed($_POST['user_email'])){
                        $goto = $GLOBALS['webhost']['base_url']."/user/confirm";
                    }
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
            
		    header('Content-Type: application/json; charset=utf-8');
            if(empty($this->errors)){
                //$this->loginUser($userInfo['id'], $userInfo['name'], "User");
                echo json_encode(['goto' => $goto]);
                header("HTTP/1.1 200 OK");
            }else{
                echo json_encode(['errors' => $this->errors]);
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
	public function register(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $userModel = $this->model('UserModel');

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

            /*Send confirmation SMS*/
            //$SMSservice = $this->service('sms');
            //$SMSservice->sendConfirmationCode($mobile, $result['code']);

            /*Login*/
		    header('Content-Type: application/json; charset=utf-8');
            if(empty($this->errors)){
                //$this->loginUser($result['id'], $result['name'], "User");
                echo json_encode(['goto' => ""]);
                header("HTTP/1.1 200 OK");
            }else{
                echo json_encode(['errors' => $this->errors]);
                header("HTTP/1.1 400 Bad Request");
            }
        }
    }
    public function confirm(){

    }
    private function loginUser($userid, $name, $type){
        $_SESSION['user_identification'] = $userid;
        $_SESSION['user_name'] = $name;
        $_SESSION['login_time'] = time();
        $_SESSION['login_type'] = $type;        
    }
}