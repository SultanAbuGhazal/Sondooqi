<?php

class Controller{
    protected $errors = [];
    protected function model($model){
        require_once '../app/models/'.$model.'.php';
        return new $model();
    }
    protected function service($service){
        require_once '../app/services/'.$service.'.php';
        return new $service();
    }
    protected function view($view, &$data = [], &$errors = []){
        require_once '../app/views/'.$view.'.php';
    }
    protected function getSnippet($snippet, $data = []){
        include '../app/views/snippets/'.$snippet.'.php';
    }
    function timeElapsedString($datetime, $full = false) {
        $now = new DateTime();
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
	function userIsLoggedIn(){
		return isset($_SESSION['user_identification']);
	}
}