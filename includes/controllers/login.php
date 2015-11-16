<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();

    }

    function index($error = '') {
        echo Hash::create('sha256', 'password', HASH_PW_KEY);
        if (isset($_GET['error'])) {
            switch ($_GET['error']) {
                case 1:
                    $this->view->error = ["Invalid Username/Password!",'danger'];
                    break;
                case 2:
                    $this->view->error = ["You must login first",'warning'];
                    break;
            }
        }
        $this->view->title = 'Login';
        $this->view->render('login/index');
    }

    
    function doAuth() {
        $this->loadModel('User');
        $this->model->authenticate();
        if($_SESSION['loggedIn'] === true) {
            header('Location: ../wall');
        }
        else {
            header('Location: ../login?error=1');
        }
    }

    function doLogout() {
        Session::destroy();
    }
}