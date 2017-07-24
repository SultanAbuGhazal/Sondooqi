<?php

class Admin extends Controller {
	public function defaultMethod(){
        //No default method, get home view
        header("Location: ".$GLOBALS['webhost']['base_url']."/admin/dashboard");
        exit;
    }
	public function dashboard(){
        //Get the view
        $this->view('dashboard/dashboard');
    }
	public function insertItem(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $goto = "";
            $itemModel = $this->model('ItemModel');
            $fileModel = $this->model('FilesModel');

            $image = $fileModel->insertImage(
                $_FILES['photo']["tmp_name"], 
                $_FILES['photo']["name"],
                [
                    'size' => $_FILES['photo']["size"],
                    'type' => $_FILES['photo']["type"]
                ]
            );

            if(isset($image))
                $itemModel->createNewItem($image, $_POST['weight'], $_POST['boxid']);

            if(!$itemModel->errorsExist() && !$fileModel->errorsExist() && empty($this->errors)){
                echo json_encode(['goto' => $goto]);
                header("HTTP/1.1 200 OK");
            }else{
                echo json_encode(['errors' => array_merge($itemModel->getErrors(), $fileModel->getErrors(), $this->errors)]);
                header("HTTP/1.1 400 Bad Request");
            }
        }
    }
	public function updateBatch(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $goto = "";            
            $itemModel = $this->model('ItemModel');
            $itemModel->updateBatchStatus($_POST['batchid'], $_POST['newstatus']);

            if(!$itemModel->errorsExist() && empty($this->errors)){
                echo json_encode(['goto' => $goto]);
                header("HTTP/1.1 200 OK");
            }else{
                echo json_encode(['errors' => array_merge($itemModel->getErrors(), $fileModel->getErrors(), $this->errors)]);
                header("HTTP/1.1 400 Bad Request");
            }
        }
    }
}