<?php

/*Version 2.0*/

class FilesModel extends Model{
    private $imagesfolder = '';
    public function __construct() {
        $this->dbhost = $GLOBALS['file_database']['host'];
        $this->dbname = $GLOBALS['file_database']['name'];
        $this->dbusername = $GLOBALS['file_database']['user'];
        $this->dbpassword = $GLOBALS['file_database']['pass'];
        
        $this->imagesfolder = $GLOBALS['file_database']['rel_imagesfolder'];
    }

    public function insertImage($tmpPath, $name, $options = []){
        //check if it is really an image...
        ////
        ///////

        $stmt = $this->getConnection()->prepare('INSERT INTO images 
        VALUES(:imgid, :basename, :imgname, :imgsize, :imgtype, :imgheight, :imgwidth, now())');        
        $stmt->bindParam(':imgid', $imgid, PDO::PARAM_STR);
        $stmt->bindParam(':basename', $basename, PDO::PARAM_STR);
        $stmt->bindParam(':imgname', $imgname, PDO::PARAM_STR);
        $stmt->bindParam(':imgsize', $imgsize, PDO::PARAM_INT);
        $stmt->bindParam(':imgtype', $imgtype, PDO::PARAM_STR);
        $stmt->bindParam(':imgheight', $imgheight, PDO::PARAM_INT);
        $stmt->bindParam(':imgwidth', $imgwidth, PDO::PARAM_INT);
        
        $imgid = $this->generateFileID();
        
        
        $imgpath = $this->imagesfolder . $imgid . "." . explode(".", $name)[1];             
        $basename = $imgid . "." . explode(".", $name)[1]; 

        if(!move_uploaded_file($tmpPath, $imgpath)){
            $this->errors[] = "Failed to upload the image: $name";
            return false;
        }

        $imgname = $name;
        $imgsize = isset($options['size']) ? intval($options['size']) : 0;
        $imgtype = isset($options['type']) ? $options['type'] : '';
        $imgheight = isset($options['height']) ? intval($options['height']) : 0;
        $imgwidth = isset($options['width']) ? intval($options['width']) : 0;
        
        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            if($GLOBALS['developerMode']){
                $this->errors[] = $Exp->getMessage();
            }
            return false;
        } 

        return $imgid;
    }
    public function getImagePath($imgid){
        $stmt = $this->getConnection()->prepare('SELECT basename FROM images AS P
        WHERE imgid=:imgid');        
        $stmt->bindParam(':imgid', $imgid, PDO::PARAM_STR);

        try{ $stmt->execute();
        }catch(PDOException $Exp){
            $this->errors[] = "Unexpected error occured!";
            if($GLOBALS['developerMode']){
                $this->errors[] = $Exp->getMessage();
            }
            return false;
        }
        
        $count = $stmt->rowCount();
        if($count < 1){
            $this->errors[] = "File not found!";
            return false;
        }else if($count > 1){
            //Warning: $count images with the same ID
            //very unlikely
        }

        $row = $stmt->fetchObject();
        return $this->imagesfolder . $row->basename;
    }
    private function generateFileID($len = 16) {
        $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $setlen = strlen($charset);
        $res = '';
        for ($i = 0; $i < $len; $i++) {
            $res .= $charset[rand(0, $setlen - 1)];
        }
        return $res;
    }
}