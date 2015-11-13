<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();    
    }
    
    function index() 
    {    
        $this->view->title = 'Login';
        echo 'login';
        $this->view->render('login/index');
    }
    
    function doAuth()
    {
        $this->loadModel('User');
        echo 'auth';
        $this->model->authenticate();
    }
    

}