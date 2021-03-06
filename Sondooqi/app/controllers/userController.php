<?php

class User extends Controller {
    /*No error handeling for user mobile confirmation*/
	public function defaultMethod(){
        //No default method, get home view
        header("Location: ".$GLOBALS['webhost']['base_url']."/home");
        exit;
    }
    public function login(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->validateLoginForm($_POST);
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
            $this->validateRegisterForm($_POST);
            $userModel = $this->model('UserModel');
            $goto = $GLOBALS['webhost']['base_url']."/user/confirm";

            /*Check email and phone number uniqueness*/
            if(empty($this->errors)){
                if($userModel->emailIsUsed($_POST['user_email'])){
                    $this->errors[] = "!هذا البريد الإكتروني مستخدم";
                }
                if($userModel->mobileIsUsed($_POST['user_mobile'])){
                    $this->errors[] = "!رقم الجوال هذا مستخدم";
                }
            }
            
            /*Insert Address*/
            if(empty($this->errors)){
                $addressModel = $this->model('AddressModel');
                $address_id = $addressModel->insertAddress(
                    $_POST['user_name'], 
                    $_POST['user_mobile'], 
                    $_POST['user_address'], 
                    $_POST['user_nearby'], 
                    "",
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

            /*Go to confirmation page*/
		    header('Content-Type: application/json; charset=utf-8');
            if(empty($this->errors)){
                $_SESSION['unconfirmed_user_id'] = $result['id'];
                $_SESSION['unconfirmed_user_name'] = $result['name'];
                $_SESSION['unconfirmed_user_mobile'] = $result['mobile'];
                /*Send confirmation SMS*/
                $this->sendUserConfirmationCode();

                echo json_encode(['goto' => $goto]);
                header("HTTP/1.1 200 OK");
            }else{
                echo json_encode(['errors' => $this->errors]);
                header("HTTP/1.1 400 Bad Request");
            }
        }
    }
    public function confirm(){
        if($this->userIsLoggedIn()){
            header("Location: ".$GLOBALS['webhost']['base_url']."/home"); exit;
        }
        $data = ['mobile' => "<br>"];
        if(isset($_SESSION['unconfirmed_user_id'])){
            $userModel = $this->model('UserModel');
            $mobile = $userModel->getUserMobile($_SESSION['unconfirmed_user_id']);
            $data = ['mobile' => $mobile];
        }

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

            }else $this->errors[] = "رقم التأكيد غير صحيح!";

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
    public function resetPassword($args){        
        if($_SERVER["REQUEST_METHOD"] == "POST"){    
            $goto = $GLOBALS['webhost']['base_url']."/home";
            $this->validatePasswordResetForm($_POST);

            if(empty($this->errors)){
                $userModel = $this->model('UserModel');
                $userModel->changeForgottenPassword($_POST['code'], $_POST['new_pass']);

                if($userModel->errorsExist()){
                    $this->errors[] = "!لم ينجح تغيير كلمة السر";
                }
            }

            header('Content-Type: application/json; charset=utf-8');
            if(empty($this->errors)){
                echo json_encode(['goto' => $goto]);
                header("HTTP/1.1 200 OK");
            }else{
                echo json_encode(['errors' => $this->errors]);
                header("HTTP/1.1 400 Bad Request");
            }
        }else{
            $userModel = $this->model('UserModel');
            $userModel->validateForgotPasswordCode($args[0]);
            if(!$userModel->errorsExist()){
                $data = ['code' => $args[0]];
                $this->view('password/password', $data);
            }else header("Location: ".$GLOBALS['webhost']['base_url']."/home");
        }
    }
    function forgotPassword(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $goto = $GLOBALS['webhost']['base_url']."/home";
            if($_POST['user_email'] == ""){
                $this->errors[] = "!يجب عليك أن تكتب بريدك الإلكتروني";
            }

            if(empty($this->errors)){
                $userModel = $this->model('UserModel');
                $code = $userModel->userForgotPassword($_POST['user_email']); 

                if($userModel->errorsExist()){
                    $this->errors[] = "!لم ينجح الطلب";
                    if($GLOBALS['developerMode']){
                        $this->errors = array_merge($this->errors, $userModel->getErrors());
                    }
                }
            }
            
            if(empty($this->errors)){
                $passwordChangeLink = $GLOBALS['webhost']['base_url']."/user/resetPassword/".$code;
                $emailService = $this->service('email');
                $emailService->sendPasswordChangeEmail($_POST['user_email'], $passwordChangeLink); 
            }

            if(empty($this->errors)){
                echo json_encode(['goto' => $goto]);
                header("HTTP/1.1 200 OK");
            }else{
                echo json_encode(['errors' => $this->errors]);
                header("HTTP/1.1 400 Bad Request");
            }
        }        
    }
    public function changeMobile(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){    
            $goto = "";
            $userModel = $this->model('UserModel');
            $userModel->changeUserMobile($_SESSION['unconfirmed_user_id'], $_POST['new-mobile']);

            if($userModel->errorsExist()){
                $this->errors[] = "لم ينجح تعديل رقم الجوال!";
            }else{
                $this->sendUserConfirmationCode();
            }

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
    public function resendCode(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $goto = "";
            if($this->sendUserConfirmationCode() === true){
                //good
            }else{
                $this->errors[] = "لم تنجح إعادة الإرسال!";
            }

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
    private function sendUserConfirmationCode(){
        if($this->userIsTemp()){
            $userModel = $this->model('UserModel');
            $code = $userModel->getUserConfirmationCode($_SESSION['unconfirmed_user_id']);
            $mobile = $userModel->getUserMobile($_SESSION['unconfirmed_user_id']);

            if($userModel->errorsExist()){
                return false;
            }else{                
                $SMSservice = $this->service('sms');
                $SMSservice->sendConfirmationCode($mobile, $code);
                return true;
            }
            return false;
        }
        return false;
    }
    private function logoutUser(){
        //Unset and Destroy
        $_SESSION = array();
        session_destroy();
    }
    private function loginTempUser(){

    }
    private function userIsTemp(){
        return true;
    }
    private function loginUser($userid, $name, $type){
        $_SESSION['user_identification'] = $userid;
        $_SESSION['user_name'] = $name;
        $_SESSION['login_time'] = time();
        $_SESSION['login_type'] = $type;        
    }
    private function validateRegisterForm(&$post){
        foreach($post as $i){
            if($i == ""){
                $this->errors[] = "!الرجاء ملء جميع الخانات";
                return;
            }
        }

        if(!isset($post['user_accept'])){
            $this->errors[] = "!حتى تتمكن من التسجيل، يجب أن توافق على الشروط والأحكام";
            return;
        }

        if(!filter_var($post['user_email'], FILTER_VALIDATE_EMAIL))
            $this->errors[] = "!البريد الإلكتروني غير صحيح";

        if(strlen($post['user_pass']) < 8)
            $this->errors[] = "!يجب أن تكون كلمة السر ثمانية أحرف أو أكثر";

    }
    private function validateLoginForm(&$post){
        foreach($_POST as $i){
            if($i == ""){
                $this->errors[] = "!الرجاء كتابة البريد الإلكتروني وكلمة السر";
                return;
            }
        }
    }
    private function validatePasswordResetForm(&$post){
        foreach($_POST as $i){
            if($i == ""){
                $this->errors[] = "!جميع الخانات مطلوبة";
                return;
            }
        }

        if($post['new_pass'] != $post['confirm_pass']){
            $this->errors[] = "!هناك خطأ، كلمتي السر لا تتطابقان";
        }
    }
}