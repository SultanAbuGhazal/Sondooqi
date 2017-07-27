<?php

class BatchModel extends Model{
    function createNewBatch(){
        /*
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
        */
    }
    function getBatchesList(){
        $stmt = $this->getConnection()->prepare('SELECT batchid, creation_time FROM batches');

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            $this->reportExpection($Exp);
            return false;
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}