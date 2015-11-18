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

    public function doProfileInfo()
    {
        $isValid = true;
        //Server-Side check if address conforms
        if (preg_match('/^.{4,20}$/', $_POST['address']) === 1){
            $this->newUser['address'] = $_POST['address'];
        }
        else {
            $this->view->addressError = 'Address must be between 4 and 20 characters.';
            $isValid = false;
        }

        //Server-Side check if city conforms
        if (preg_match('/^.{4,20}$/', $_POST['city']) === 1) {
            $this->newUser['city'] = $_POST['city'];
        }
        else {
            $this->view->cityError = 'City must be between 4 and 20 characters.';
            $isValid = false;
        }

        //Server-side check if Province conforms
        if (preg_match('/^.{4,20}$/', $_POST['province']) === 1) {
            $this->newUser['province'] = $_POST['province'];
        }
        else {
            $this->view->provinceError = 'Address must be between 4 and 20 characters.';
            $isValid = false;
        }

        if($this->model->validateCountry($_POST['country'])){
            $this->newUser['country'] = $_POST['country'];
        }
        else {
            $this->view->provinceError = 'Country value given does not exist.';
            $isValid = false;
        }

        if($isValid) {
            Session::set('register', $this->newUser);
            header('Location: ' . URL . 'register/page/3');
        }
        else {
            $this->view->title = 'ERROR - Profile information';
            $this->view->countries = $this->model->getCountries();
            $this->view->render('register/profileInfo');
        }
    }

    public function doAuthInfo()
    {
        $isValid = true;

        if (preg_match('/^([A-z]|\d){2,16}$/', $_POST['username']) === 1) {
            if ($this->model->validateUsername($_POST['username']) === false) {
                $this->view->usernameError = 'Username already exists. Please select another username';
                $isValid = false;
            } else {
                $this->newUser['username'] = $_POST['username'];
            }
        } else {
            $this->view->usernameError = 'Username does not conform to requirements';
            $isValid = false;
        }

        if (preg_match('/^([A-z]|\d){6,16}$/', $_POST['password']) === 1) {
            if ($_POST['password'] == $_POST['confPassword'])
                $this->newUser['password'] = $_POST['password'];
            else {
                $this->view->passwordError = 'Passwords don\'t match';
                $isValid = false;
            }
        } else {
            $this->view->passwordError = 'Passwords does not meet requirements';
            $isValid = false;
        }

        if ($isValid) {
            Session::set('register', $this->newUser);
            header('Location: ' . URL . 'register/page/2');
        } else {
            $this->view->title = 'ERROR - Login information';
            $this->view->render('register/authenticationInfo');
        }
    }
}