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
            $this->view->genders = $this->model->getGenders();
            $this->view->minDate = date_sub(date_create(), date_interval_create_from_date_string('3 years'));
            $this->view->render('register/userInfo');
        } elseif ($page == 3) {
            $this->view->title = 'Profile information';
            $this->view->countries = $this->model->getCountries();
            $this->view->render('register/addressInfo');
        } elseif ($page == 4) {
            $this->view->title = 'Confirm information';
            $this->view->render('register/regConfirm');
        } else {
            $this->view->render('register/index');
        }
    }

    public function doUserInfo()
    {
        $isValid = true;
        //ServerSide check if first name conforms
        if (preg_match('/^([A-z]){2,20}$/', $_POST['first_name']))
            $this->newUser['first_name'] = $_POST['first_name'];
        else {
            $this->view->firstNameError = 'Your name cannot contain numbers and must be'
                . 'between 2 and 20 characters';
            $isValid = false;
        }

        //ServerSide check if last name conforms
        if (preg_match('/^([A-z]){2,20}$/', $_POST['last_name']))
            $this->newUser['last_name'] = $_POST['last_name'];
        else {
            $this->view->lastNameError = 'Your name cannot contain numbers and must be'
                . 'between 2 and 20 characters';
            $isValid = false;
        }

        if ($this->model->validateGender($_POST['gender_id']))
            $this->newUser['gender_id'] = $_POST['gender_id'];
        else {
            //By unanimous decision; this is the official error.
            //If you see this sir, we sincerely apologize. Its 3AM and sleep is presently non-existent.
            $this->view->genderError = 'This gender doesn\'t exist in our database. Perhaps consider going to' .
                'straight camp';
            $isValid = false;
        }

        //Commence ridiculous date checks
        $date_today = date_create();
        $date_birthDate = date_create($_POST['date_of_birth']);
        if (preg_match('/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/', $_POST['date_of_birth'])
            && (int)date_diff($date_birthDate, $date_today)->format('%r%y') >= 13
        )
            $this->newUser['date_of_birth'] = $_POST['date_of_birth'];
        else {
            $this->view->dobError = 'You must be 13 years or older to join';
            $isValid = false;
        }

        if ($isValid) {
            Session::set('register', $this->newUser);
            header('Location: ' . URL . 'register/page/4');
        } else {
            $this->view->title = 'ERROR - User information';
            $this->view->genders = $this->model->getGenders();
            $this->view->render('register/userInfo');
        }
    }

    public function doProfileInfo()
    {
        $isValid = true;
        //Server-Side check if address conforms
        if (preg_match('/^.{4,20}$/', $_POST['address']) === 1)
            $this->newUser['address'] = $_POST['address'];
        else {
            $this->view->addressError = 'Address must be between 4 and 20 characters.';
            $isValid = false;
        }

        //Server-Side check if city conforms
        if (preg_match('/^.{4,20}$/', $_POST['city']) === 1)
            $this->newUser['city'] = $_POST['city'];
        else {
            $this->view->cityError = 'City must be between 4 and 20 characters.';
            $isValid = false;
        }

        //Server-side check if Province conforms
        if (preg_match('/^.{4,20}$/', $_POST['province']) === 1)
            $this->newUser['province'] = $_POST['province'];
        else {
            $this->view->provinceError = 'Address must be between 4 and 20 characters.';
            $isValid = false;
        }

        if ($this->model->validateCountry($_POST['country']))
            $this->newUser['country'] = $_POST['country'];
        else {
            $this->view->provinceError = 'Country value given does not exist.';
            $isValid = false;
        }

        if ($isValid) {
            Session::set('register', $this->newUser);
            header('Location: ' . URL . 'register/page/3');
        } else {
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