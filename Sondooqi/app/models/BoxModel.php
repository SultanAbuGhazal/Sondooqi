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
    function getBoxItems($boxid){

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
}