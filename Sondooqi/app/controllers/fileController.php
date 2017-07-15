<?php

class File extends Controller {
	public function defaultMethod(){
        //A request to www.bestfix.ae/file is not valid
        //Default method is not used, redirect to home page
        header("Location: ".$GLOBALS['webhost']['base_url']."/home");
    }
    public function m($imgid = [""]){
        //Take the first parameter
        $imgid = $imgid[0];

        /*
        Get the corresponding path from the files database
        through the FilesModel
        */
        $fileModel = $this->model('FilesModel');
        $imgpath = $fileModel->getImagePath($imgid);
        
        //Set the header and output the image
        /*
        This should change according to image type
        Hint: use exif_imagetype()
        Also, this is the only echo from a controller
        no view is needed.
        */
        header("content-type: image/png");
        echo file_get_contents($imgpath);
    }
    public function f($fileid = [""]){
        //This will be used for other types of files
    }
}