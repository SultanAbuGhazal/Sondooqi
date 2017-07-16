<?php

class Profile extends Controller {
	public function defaultMethod(){
        //Get the view
        $this->view('home/home');
    }
    public function box(){
        $boxModel = $this->model('BoxModel');
        $boxes = $boxModel->getUserBoxes($_SESSION['user_identification']);
        $items = [];
        foreach($boxes as &$box){
            $items = $boxModel->getBoxItems($box['boxid']);
            $box['items'] = $items;
        }

        $viewData = [
            'boxes' => $boxes
        ];
        $this->view('box/box', $viewData);
    }
    public function address(){
        $addressModel = $this->model('AddressModel');
        $addresses = $addressModel->getUserAddresses($_SESSION['user_identification']);

        $viewData = [
            'addresses' => $addresses
        ];
        $this->view('address/address', $viewData);
    }
}