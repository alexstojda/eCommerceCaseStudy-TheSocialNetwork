<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        //echo Hash::create('sha256', 'password', HASH_PW_KEY);

        $this->view->title = 'Home';
        $this->view->render('home/index');

    }
    
}