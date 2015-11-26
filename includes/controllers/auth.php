<?php

/**
 * Class Login
 *
 * Deals with user authentication
 * @property _Recovery recovery
 */
class Auth extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        self::checkCookie();
        //If already logged in, go to member area
        if (Session::get('my_user')) {
            header('Location: ../wall');
        }

        //logout alert
        if (isset($_GET['logout'])) {
            $this->view->alerts[] = ["You've logged out.", 'success'];
        } else if (isset($_GET['created']))
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
        $name = '';
        $pass = '';
        /** @var _User $user */
        $user = $this->getModel('User');
        if (array_key_exists('rememberBana', $_COOKIE)) {
            parse_str($_COOKIE['rememberBana']);
        } else {
            $name = $_POST['inputUser'];
            $pass = Hash::create('sha256', $_POST['inputPassword'], HASH_PW_KEY);;
        }

        if ($user->authenticate($name, $pass)) {
            if (array_key_exists('remember', $_POST))
                setcookie('rememberBana', 'name=' . $name . '&pass=' . $pass, time() + (3600 * 24 * 30));
            header('Location: ../timeline');
        } else {
            header('Location: ../auth?error=1');
        }
    }

    //destroy session aka logout
    public function doLogout()
    {
        Session::clear('my_user');
        //Session::destroy();
        unset($_COOKIE);
        setcookie('rememberBana', '', time() - 3600);
        header('Location: ../auth?logout=1');
        exit();
    }

    public function sendRecovery()
    {
        $email = $_POST['email'];

        /** @var _Recovery $model */
        $model = $this->getModel('Recovery');

        $result = $model->newRequest($email);

        if ($result === 0) {
            $this->view->alerts[] = ["$email does not exist. Please enter a valid email.", 'warning'];
            $this->view->render('auth/recover');
        } elseif ($result === -1) {
            $this->view->alerts[] = ["Something went wrong, please try again. If the error persists, contact the code monkeys",
                'danger'];
            $this->view->render('auth/recover');
        } elseif ($result === 1) {
            $this->view->alerts[] = ["<strong>Success!</strong> You should receive a link in your email to reset your password shortly.",
                'success'];
            $this->view->render('auth/recover');
        }
    }

    public function recover($doReset = null)
    {
        if (!isset($doReset)) {
            $this->view->render('auth/recover');
        } elseif ($doReset = 'doReset') {
            $key = $_GET['key'];
            $email = $_GET['email'];

            /** @var _Recovery $model */
            $model = $this->getModel('Recovery');

            $uid = $model->validateRequest($model->getUIDFromEmail($email), $key);
            if ($uid === false) {
                $this->view->alerts[] = ["Your request is invalid. Please try again with a valid email and reset key",
                    'warning'];
                $this->view->render('auth/recover');
            } else {
                $this->view->render('auth/passwordreset');
            }
        }
    }

    public function doReset()
    {

    }
}