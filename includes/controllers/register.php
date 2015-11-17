<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-12
 * Time: 5:08 PM
 * @property _User newUser
 * @property  model
 */
class register extends Controller
{
    /**
     * @var _Register
     */
    protected $model;

    /**
     * register constructor.
     */
    public function __construct()
    {
        parent::__construct();
        if (!Session::get('register')) {
            Session::set('register', Array());
        }
        $this->newUser = Session::get('register');
        $this->view->newUser = $this->newUser;
    }

    public function index()
    {
        $this->view->title = 'Create new account';
        $this->page(0);
    }

    public function page($page)
    {
        if ($page == 1) {
            $this->view->title = 'Login information';
            $this->view->render('register/authenticationInfo');
        } elseif ($page == 2) {
            $this->view->title = 'Profile information';
            $this->view->countries = $this->model->getCountries();
            $this->view->render('register/profileInfo');
        } else {
            $this->view->render('register/index');
        }
    }

    public function doAuthInfo()
    {

        if (preg_match('/^([A-z]|\d){2,16}$/', $_POST['username']) === 1) {
            if ($this->model->validateUsername($_POST['username']) === false) {
                $this->view->usernameError = 'Username already exists. Please select another username';
                $this->view->render('register/authenticationInfo');
                return false;
            } else {
                $this->newUser['username'] = $_POST['username'];
            }
        } else {
            $this->view->usernameError = 'Username does not conform to requirements';
            $this->view->render('register/authenticationInfo');
            return false;
        }

        if (preg_match('/^([A-z]|\d){6,16}$/', $_POST['password']) === 1) {
            if ($_POST['password'] == $_POST['confPassword'])
                $this->newUser['password'] = $_POST['password'];
            else {
                $this->view->passwordError = 'Passwords don\'t match';
                $this->view->render('register/authenticationInfo');
                return false;
            }
        } else {
            $this->view->passwordError = 'Passwords does not meet requirements';
            $this->view->render('register/authenticationInfo');
            return false;
        }

        Session::set('register', $this->newUser);
        header('Location: ' . URL . 'register/page/2');
        return true;
    }
}