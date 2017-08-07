<?php

class Home extends Controller {
	public function defaultMethod(){
        //Get the view
        $this->view('home/home');
    }
    public function about(){
        //Get the view
        $this->view('about/about');
    }
    public function terms(){
        //Get the view
        $this->view('T&C/T&C');
    }
}