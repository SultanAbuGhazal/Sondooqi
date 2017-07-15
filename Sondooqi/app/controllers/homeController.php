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
}