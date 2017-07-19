<?php

class BoxModel extends Model{
    public $uaebox_address = "ADuaebox";
    function createNewBox($userid, $country, $capacity, $address){
        $stmt = $this->getConnection()->prepare('INSERT INTO boxes
        VALUES(:boxid, :userid, :country, :capacity, :address)');
        $stmt->bindParam(':boxid', $id, PDO::PARAM_STR);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->bindParam(':capacity', $capacity, PDO::PARAM_INT);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        
        $id = $this->generateBoxID();      

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }
        
        return $id;
    }
    function getUserBoxes($userid){
        $stmt = $this->getConnection()->prepare('SELECT boxid, country FROM boxes AS B WHERE B.user=:userid');        
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            if($GLOBALS['developerMode']){
                $this->errors[] = $Exp->getMessage();
            }
            return false;
        }
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getBoxItems($boxid){
        $stmt = $this->getConnection()->prepare('SELECT * FROM items AS I WHERE I.box=:boxid');        
        $stmt->bindParam(':boxid', $boxid, PDO::PARAM_STR);

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            if($GLOBALS['developerMode']){
                $this->errors[] = $Exp->getMessage();
            }
            return false;
        }
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    private function generateBoxID() {
        $len = 6;
        $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $setlen = strlen($charset);
        $res = '';
        for ($i = 0; $i < $len; $i++) {
            $res .= $charset[rand(0, $setlen - 1)];
        }
        return "BX".$res;
    }
    private function creatBoxAddress(){
        
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


    }
}