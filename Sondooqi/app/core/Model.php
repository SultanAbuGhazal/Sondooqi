<?php

class Model{
    protected $dbhost = 'localhost';
    protected $dbname = '';
    protected $dbusername = '';
    protected $dbpassword = '';
    protected $errors = [];

    function __construct() {
        $this->dbhost = $GLOBALS['database']['host'];
        $this->dbname = $GLOBALS['database']['name'];
        $this->dbusername = $GLOBALS['database']['user'];
        $this->dbpassword = $GLOBALS['database']['pass'];
    }
    function getConnection(){
        $conn = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname;charset=utf8", $this->dbusername, $this->dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    function generateFileID($len = 16) {
        $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $setlen = strlen($charset);
        $res = '';
        for ($i = 0; $i < $len; $i++) {
            $res .= $charset[rand(0, $setlen - 1)];
        }
        return $res;
    }
    function errorsExist(){
        return !empty($this->errors);
    }
    function getErrors(){
        return $this->errors;
    }
    function reportExpection($exp){
        $this->errors[] = $exp->getMessage();
    }
}