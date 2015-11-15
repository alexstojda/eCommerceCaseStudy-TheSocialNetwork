<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();    
    }
    
    function index($error = 0)
    {   $this->error = $error;
        $this->view->title = 'Login';
        $this->view->render('login/index');
    }
    
    function doAuth()
    {
        $this->loadModel('User');
        $this->model->authenticate();
        if($_SESSION['loggedIn'] === true) {
            header('Location: ../wall');
        }
        else {
            header('Location: ../login');
        }
    }
    

}