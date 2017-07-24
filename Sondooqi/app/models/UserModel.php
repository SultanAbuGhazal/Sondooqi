<?php

class UserModel extends Model{
    function emailIsUsed($email){
        $stmt = $this->getConnection()->prepare('SELECT usremail FROM users WHERE usremail=:email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR); 

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }

        if($stmt->rowCount() > 0)
            return true;
        return false;
    }
    function mobileIsUsed($mobile){
        $stmt = $this->getConnection()->prepare('SELECT usrmobile FROM users WHERE usrmobile=:mobile');
        $stmt->bindParam(':mobile', $mobile, PDO::PARAM_STR); 

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }

        if($stmt->rowCount() > 0)
            return true;
        return false;
    }
    function userIsValid($email){
        $stmt = $this->getConnection()->prepare('SELECT usrid, fullname, usrmobile FROM users WHERE usremail=:email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR); 

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }

        if($stmt->rowCount() != 1){
            $this->errors[] = "Found ".$stmt->rowCount()." entries, there must be exactly 1.";
            return false;
        }

        $result = $stmt->fetchObject();
        return [
            "id" => $result->usrid,
            "name" => $result->fullname,
            "mobile" => $result->usrmobile
        ];
    }
    function loginIsNotAllowed($email){
        $stmt = $this->getConnection()->prepare('SELECT allow_login FROM users AS U
        JOIN accstatus AS S ON U.accstatus=S.accstatusid
        WHERE U.usremail=:email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }
        
        $row = $stmt->fetchObject();
        return ($row->allow_login == "0") ? true : false;
    }
    function mobileIsNotConfirmed($email){
        $stmt = $this->getConnection()->prepare('SELECT mobile_confirmed FROM users AS U
        JOIN accstatus AS S ON U.accstatus=S.accstatusid
        WHERE U.usremail=:email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }
        
        $row = $stmt->fetchObject();
        return ($row->mobile_confirmed == "0") ? true : false;
    }
    function userIsAuthentic($userid, $email, $pass){
        $stmt = $this->getConnection()->prepare('SELECT usrid FROM users
        WHERE usrid=:userid AND usremail=:email AND usrpass=:pass');
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR); 
        $stmt->bindParam(':email', $email, PDO::PARAM_STR); 
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);

        $pass = $this->generateHash($pass, $userid);

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }

        if($stmt->rowCount() != 1) return false;

        return true;
    }
    function getUserPrivilege($userid){
        $stmt = $this->getConnection()->prepare('SELECT T.* FROM users AS U
        JOIN usrtype AS T ON U.usrtype=T.usrtypeid WHERE usrid=:usrid');
        $stmt->bindParam(':usrid', $userid, PDO::PARAM_STR); 

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }

        if($stmt->rowCount() != 1){
            $this->errors[] = "Found ".$stmt->rowCount()." entries, there must be exactly 1.";
            return false;
        }

        return $stmt->fetchObject();
    }
    function getUserConfirmationCode($userid){
        $stmt = $this->getConnection()->prepare('SELECT confirmation_code FROM users
        WHERE usrid=:usrid');
        $stmt->bindParam(':usrid', $userid, PDO::PARAM_STR);

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }

        if($stmt->rowCount() != 1){
            $this->errors[] = "Found ".$stmt->rowCount()." entries, there must be exactly 1.";
            return false;
        }

        return $stmt->fetchObject()->confirmation_code;
    }
    function getUserMobile($userid){
        $stmt = $this->getConnection()->prepare('SELECT usrmobile FROM users
        WHERE usrid=:usrid');
        $stmt->bindParam(':usrid', $userid, PDO::PARAM_STR);

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }

        if($stmt->rowCount() != 1){
            $this->errors[] = "Found ".$stmt->rowCount()." entries, there must be exactly 1.";
            return false;
        }

        return $stmt->fetchObject()->usrmobile;
    }
    function createNewUser($address_id, $name, $pass, $email, $mobile){
        $stmt = $this->getConnection()->prepare('INSERT INTO users
        VALUES (:userid, :address, :fullname, :pass, :email, :mobile, NOW(), :code, NOW(), 1, 1)');
        $stmt->bindParam(':userid', $id, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address_id, PDO::PARAM_STR);
        $stmt->bindParam(':fullname', $name, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $hash, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $stmt->bindParam(':code', $confirmation_code, PDO::PARAM_STR);
        
        $id = $this->generateUserID();
        $hash = $this->generateHash($pass, $id);  
        $confirmation_code = $this->generateConfirmationCode();

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }
        
        return [
            "id" => $id,
            "name" => $name,
            "code" => $confirmation_code
        ];
    }
    function confirmUser($userid){
        $stmt = $this->getConnection()->prepare('UPDATE users SET accstatus=2 WHERE usrid=:userid');
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR); 

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }

        if($stmt->rowCount() != 1){
            $this->errors[] = "Found ".$stmt->rowCount()." entries, there must be exactly 1.";
            return false;
        }

        return true;
    }
    function deleteUserEntry($userid){
        $stmt = $this->getConnection()->prepare('DELETE FROM users WHERE usrid=:userid');
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR); 

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }
    }
    private function generateHash($password, $salt){
        return hash('sha256', $password.$salt.$password);
    }
    private function generateUserID() {
        $len = 13;
        $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $setlen = strlen($charset);
        $res = '';
        for ($i = 0; $i < $len; $i++) {
            $res .= $charset[rand(0, $setlen - 1)];
        }
        return "UID".$res;
    }
    private function generateConfirmationCode() {
        $len = 6;
        $charset = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $setlen = strlen($charset);
        $res = '';
        for ($i = 0; $i < $len; $i++) {
            $res .= $charset[rand(0, $setlen - 1)];
        }
        return $res;
    }
}