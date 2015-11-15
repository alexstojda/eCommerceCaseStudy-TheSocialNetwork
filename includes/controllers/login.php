<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();    
    }
    
    function index() 
    {
        if (isset($_GET['error'])){
            switch ($_GET['error']) {
                case 1:
                    $this->view->errorMessage = "You must be logged in";
                    break;
                default:
                    $this->view->errorMessage = null;
            }
        }
        $this->view->title = 'Login';

        $this->view->render('login/index');
    }

    function doLogin() {
        //TODO-andrew Make login create session and stuff.
    }

    function doLogout() {
        Session::destroy();
    }
}