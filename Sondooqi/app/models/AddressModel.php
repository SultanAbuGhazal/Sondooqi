<?php

class AddressModel extends Model{
    function insertAddress($name, $mobile, $line1, $line2, $city, $province, $country){
        $stmt = $this->getConnection()->prepare('INSERT INTO addresses
        VALUES(:addressid, :fullname, :mobile, :line_one, :line_two, :city, :province, :country, NOW())');
        $stmt->bindParam(':addressid', $id, PDO::PARAM_STR);
        $stmt->bindParam(':fullname', $name, PDO::PARAM_STR);
        $stmt->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $stmt->bindParam(':line_one', $line1, PDO::PARAM_STR);
        $stmt->bindParam(':line_two', $line2, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':province', $province, PDO::PARAM_STR);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        
        $id = $this->generateAddressID();      

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }
        
        return $id;
    }
    function getUserAddresses($userid){
        $stmt = $this->getConnection()->prepare('SELECT * FROM addresses AS A 
        WHERE A.addressid IN (SELECT location_address FROM boxes where user=:userid)');        
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
    private function generateAddressID() {
        $len = 6;
        $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $setlen = strlen($charset);
        $res = '';
        for ($i = 0; $i < $len; $i++) {
            $res .= $charset[rand(0, $setlen - 1)];
        }
        return "AD".$res;
    }
}