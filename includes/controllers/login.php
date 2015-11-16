<?php

/**
 * Class Login
 *
 * Deals with user authentication
 */
class Login extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {

        //If already logged in, go to member area
        if (Session::get('loggedIn') === true) {
            header('Location: ../member');
        }

        //logout alert
        if (isset($_GET['logout'])) {
            $this->view->error = ["You've logged out.", 'success'];
        }
        //error alerts
        else if (isset($_GET['error'])) {
            switch ($_GET['error']) {
                case 1:
                    $this->view->error = ["Invalid Username/Password!",'danger'];
                    break;
                case 2:
                    $this->view->error = ["You must login first",'warning'];
                    break;
           }
        }

        //render login partial view
        $this->view->title = 'Login';
        $this->view->render('login/index');
    }



    //Attempt to authenticate user credentials
    function doAuth() {
        $user = $this->getModel('User');

        if($user->authenticate()) {
            header('Location: ../wall?u='.Session::get('my_user')['id']);
        }
        else {
            header('Location: ../login?error=1');
        }

    }


    //destroy session aka logout
    function doLogout() {
        Session::destroy();
        header('Location: ../login?logout=1');
        exit();
    }
}