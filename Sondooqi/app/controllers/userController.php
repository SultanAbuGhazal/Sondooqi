<?php

class User extends Controller {
    public function login(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            print_r($_POST);
            exit;
            $userModel = $this->model('UserModel');

            /*Validate user*/
            if($userModel->userIsValid()){
                
            }

            /*Check account status*/
            /*Authenticate user*/

        }
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
}