<?php

class ItemModel extends Model{
    function createNewItem($photo, $weight, $boxid){
        $stmt = $this->getConnection()->prepare('INSERT INTO items
        VALUES(:id, now(), null, :weight, :boxid, null, :photo, 1)');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':weight', $weight, PDO::PARAM_INT);
        $stmt->bindParam(':boxid', $boxid, PDO::PARAM_STR);
        $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
        
        $id = $this->generateItemID();

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }
        
        return $id;
    }
    private function generateItemID() {
        $len = 13;
        $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $setlen = strlen($charset);
        $res = '';
        for ($i = 0; $i < $len; $i++) {
            $res .= $charset[rand(0, $setlen - 1)];
        }
        return "ITM".$res;
    }
}