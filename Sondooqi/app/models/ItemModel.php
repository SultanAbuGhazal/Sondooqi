<?php

class ItemModel extends Model{
    function createNewItem($photo, $weight, $boxid, $adminid = ""){
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
    function updateItemStatus($itemid, $newStatus){
        $stmt = $this->getConnection()->prepare('UPDATE items 
        SET status=(SELECT itemstatusid FROM itemstatus WHERE status_text=:newStatus)
        WHERE itemid=:itemid');
        $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_STR);
        $stmt->bindParam(':itemid', $itemid, PDO::PARAM_STR);

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }
        
        return true;
    }
    function getItemStatusesList(){
        $stmt = $this->getConnection()->prepare('SELECT itemstatusid, status_text FROM itemstatus');

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function updateBatchStatus($batchid, $newStatus){
        $stmt = $this->getConnection()->prepare('UPDATE items 
        SET status=(SELECT itemstatusid FROM itemstatus WHERE status_text=:newStatus)
        WHERE batch=:batchid');
        $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_STR);
        $stmt->bindParam(':batchid', $batchid, PDO::PARAM_INT);

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }
        
        return true;
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