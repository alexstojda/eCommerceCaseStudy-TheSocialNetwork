<?php

class Wall extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        //echo Hash::create('sha256', 'jesse', HASH_PASSWORD_KEY);
        //echo Hash::create('sha256', 'test2', HASH_PASSWORD_KEY);
        $this->view->title = 'Wall';
        $this->view->render('wall/index');
    }

    function getPosts() {
    	//This is where all the posts come form...it's pretty fucking savage
    }
    
}