<?php

/**
 * Class Login
 *
 * Deals with user authentication
 */
class Auth extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        //If already logged in, go to member area
        if (Session::get('my_user')) {
            header('Location: ../wall');
        }

        //logout alert
        if (isset($_GET['logout'])) {
            $this->view->alerts[] = ["You've logged out.", 'success'];
        }
        else if(isset($_GET['created']))
            $this->view->alerts[] = ["Account created. Please login.", 'success'];
        //error alerts
        else if (isset($_GET['error'])) {
            switch ($_GET['error']) {
                case 1:
                    $this->view->alerts[] = ["Invalid Username/Password!", 'danger'];
                    break;
                case 2:
                    $this->view->alerts[] = ["You must login first", 'warning'];
                    break;
            }
        }

        //render login partial view
        $this->view->title = 'Login';
        $this->view->render('auth/index');
    }


    //Attempt to authenticate user credentials
    public function doAuth()
    {
        $user = $this->getModel('User');

        /** @var _User $user */
        if ($user->authenticate()) {
            header('Location: ../timeline');
        } else {
            header('Location: ../auth?error=1');
        }

    }

    //destroy session aka logout
    public function doLogout()
    {
        Session::destroy();
        header('Location: ../auth?logout=1');
        exit();
    }
}