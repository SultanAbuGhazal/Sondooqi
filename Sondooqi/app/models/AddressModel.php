<?php

class AddressModel extends Model{
    function insertAddress($name, $mobile, $line1, $line2, $street="", $city, $province, $country){
        $stmt = $this->getConnection()->prepare('INSERT INTO addresses
        VALUES(:addressid, :fullname, :mobile, :line_one, :line_two, :street, :city, :province, :country, NOW())');
        $stmt->bindParam(':addressid', $id, PDO::PARAM_STR);
        $stmt->bindParam(':fullname', $name, PDO::PARAM_STR);
        $stmt->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $stmt->bindParam(':line_one', $line1, PDO::PARAM_STR);
        $stmt->bindParam(':line_two', $line2, PDO::PARAM_STR);
        $stmt->bindParam(':street', $street, PDO::PARAM_STR);
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
    function editAddress($userid, $name, $mobile, $line1, $line2, $street, $city, $province, $country){
        $stmt = $this->getConnection()->prepare('SELECT A.* FROM addresses AS A 
        JOIN users AS U ON U.address=A.addressid WHERE U.user=:userid');        
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            if($GLOBALS['developerMode']){
                $this->errors[] = $Exp->getMessage();
            }
            return false;
        }

        $old_address = $stmt->fetchObject();

        $stmt = $this->getConnection()->prepare('UPDATE addresses
        SET fullname=:name, mobile=:mobile, line_one=:line_1, line_two=:line_2, street=:street, city=:city, province=:province, country=:country
        WHERE addressid=:addressid');        
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $stmt->bindParam(':line_1', $line1, PDO::PARAM_STR);
        $stmt->bindParam(':line_2', $line2, PDO::PARAM_STR);
        $stmt->bindParam(':street', $street, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':province', $province, PDO::PARAM_STR);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->bindParam(':addressid', $old_address->addressid, PDO::PARAM_STR);

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            if($GLOBALS['developerMode']){
                $this->errors[] = $Exp->getMessage();
            }
            return false;
        }
        
        return true;
    }
    function getUserAddresses($userid){
        $stmt = $this->getConnection()->prepare('SELECT A.* FROM addresses AS A 
        JOIN boxes AS B ON B.location_address=A.addressid WHERE B.user=:userid');        
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