<?php

class BoxModel extends Model{
    function createNewBox($userid, $fullname, $country, $capacity){
        $stmt = $this->getConnection()->prepare('INSERT INTO boxes
        VALUES(:boxid, :userid, :country, :capacity, :address)');
        $stmt->bindParam(':boxid', $id, PDO::PARAM_STR);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->bindParam(':capacity', $capacity, PDO::PARAM_INT);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        
        $id = $this->generateBoxID();
        $address = $this->createBoxAddress($country, $id, $fullname);

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
        $stmt = $this->getConnection()->prepare('SELECT itemid, origin_arrival_time, weight, photo, status_text, status_text_ar
        FROM items AS I JOIN itemstatus AS S ON I.status=S.itemstatusid WHERE I.box=:boxid ORDER BY origin_arrival_time ASC');        
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
    private function createBoxAddress($country, $boxid, $fullname){
        //In this function, the Box Model uses the Address Model
        $stmt = $this->getConnection()->prepare('SELECT A.* FROM addresses AS A
        JOIN ouraddresses AS O ON A.addressid=O.address WHERE O.country=:country');        
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            if($GLOBALS['developerMode']){
                $this->errors[] = $Exp->getMessage();
            }
            return false;
        }
        
        $result = $stmt->fetchObject();

        $addressModel = $this->model('AddressModel');
        $address_id = $addressModel->insertAddress(
            $fullname,
            $result->mobile, 
            $result->line_one, 
            $boxid, 
            $result->city, 
            $result->province, 
            $result->country
        );
        return $address_id;
    }
}