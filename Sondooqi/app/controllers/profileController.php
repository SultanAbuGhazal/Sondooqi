<?php

class Profile extends Controller {
	public function defaultMethod(){
        //Get the view
        $this->view('home/home');
    }
    public function box(){
        //Get the view
        $this->view('box/box');
    }
    public function address(){
        //Get the view
        $this->view('address/address');
    }
}