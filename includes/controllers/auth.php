<?php

/**
 * Class Login
 *
 * Deals with user authentication
 * @property _Recovery recovery
 */
class auth extends controller
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
            require_once LIBS . "Hash.php";
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

    public function recover()
    {
        $this->view->render('auth/recover');
    }

    public function doReset()
    {
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
            $this->view->key = $key;
            $this->view->uid = $uid;
            $this->view->render('auth/passwordreset');
        }
    }

    public function execReset()
    {
        $newPassword = null;
        if (preg_match('/^([A-z]|\d){6,16}$/', $_POST['password']) === 1) {
            if ($_POST['password'] == $_POST['confPassword'])
                $newPassword = $_POST['password'];
            else {
                $this->view->alerts[] = ["Passwords must match",
                    'warning'];
                $this->view->render('auth/recover');
            }
        } else {
            $this->view->alerts[] = ["Your password must be between 6 and 16 alphanumeric characters",
                'warning'];
            $this->view->render('auth/recover');
        }

        if (isset($newPassword)) {
            /** @var _Recovery $model */
            $model = $this->getModel('Recovery');

            if ($model->resetPassword($_POST['uid'], $_POST['key'], $newPassword)) {
                $this->view->alerts[] = ["Success! Your password has been reset. You will be redirected to the login form in a few seconds," .
                    "or you can <a href='http://devbana.tk/auth'>click here</a>", 'success'];
                $this->view->uid = '';
                $this->view->key = '';
                header('Refresh: 5; URL=http://devbana.tk/auth');
                $this->view->render('auth/passwordreset');

            } else {
                $this->view->alerts[] = ["Something seems to have gone wrong. Return to your email and try the link again", 'danger'];
                $this->view->render('auth/passwordreset');
            }


        }
    }
}