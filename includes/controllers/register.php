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
        if (!isset($page))
            $page = 0;
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
            if (isset($this->newUser['gender_id'])) {
                $this->view->gender = $this->model->getGender($this->newUser['gender_id']);
            }
            if (isset($this->newUser['country'])) {
                $this->view->country = $this->model->getCountry($this->newUser['country']);
            }
            $this->view->canSubmit = $this->validate();
            $this->view->render('register/regConfirm');
        } else {
            $this->view->render('register/index');
        }
    }

    public function addUser()
    {
        if ($this->model->insertUser($this->newUser)) {
            Session::clear('register');
            header('Location: ' . URL . 'auth?created=1');
        } else {
            header('Location: ' . URL . 'register/page/4?error=1');
        }
    }

    public function validate()
    {
        if (!isset($this->newUser['username']))
            return false;
        elseif (!isset($this->newUser['password']))
            return false;
        elseif (!isset($this->newUser['email']))
            return false;
        elseif (!isset($this->newUser['first_name']))
            return false;
        elseif (!isset($this->newUser['last_name']))
            return false;
        elseif (!isset($this->newUser['gender_id']))
            return false;
        elseif (!isset($this->newUser['date_of_birth']))
            return false;
        elseif (!isset($this->newUser['phone']))
            return false;
        elseif (!isset($this->newUser['address']))
            return false;
        elseif (!isset($this->newUser['city']))
            return false;
        elseif (!isset($this->newUser['province']))
            return false;
        elseif (!isset($this->newUser['country']))
            return false;
        elseif (!isset($this->newUser['postalcode']))
            return false;
        else
            return true;
    }

    public function doAuthInfo()
    {
        if (!isset($_POST['submitAccount'])) {
            header('Location: ' . URL . 'register/page/1');
            return true;
        }

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

        if (preg_match('/^\S+@\S+\.\S+$/', $_POST['email']) === 1)
            if ($this->model->validateEmail($_POST['email']))
                $this->newUser['email'] = $_POST['email'];
            else {
                $this->view->emailError = 'The email is already being used';
                $isValid = false;
            }
        else {
            $this->view->emailError = 'The email is not valid';
            $isValid = false;
        }

        if ($isValid) {
            Session::set('register', $this->newUser);
            header('Location: ' . URL . 'register/page/2');
        } else {
            $this->view->title = 'ERROR - Login information';
            $this->view->render('register/authenticationInfo');
        }
        return true;
    }

    /**
     * @return bool
     */
    public function doUserInfo()
    {
        if (!isset($_POST['submitInfo'])) {
            header('Location: ' . URL . 'register/page/2');
            return true;
        }

        $isValid = true;
        //ServerSide check if first name conforms
        if (preg_match('/^([A-z]){2,20}$/', $_POST['first_name']) === 1)
            $this->newUser['first_name'] = $_POST['first_name'];
        else {
            $this->view->firstNameError = 'Your name cannot contain numbers and must be'
                . 'between 2 and 20 characters';
            $isValid = false;
        }

        //ServerSide check if last name conforms
        if (preg_match('/^([A-z]){2,20}$/', $_POST['last_name']) === 1)
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
        if (preg_match('/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/', $_POST['date_of_birth']) === 1
            && (int)date_diff($date_birthDate, $date_today)->format('%r%y') >= 13
        )
            $this->newUser['date_of_birth'] = $_POST['date_of_birth'];
        else {
            $this->view->dobError = 'You must be 13 years or older to join';
            $isValid = false;
        }

        //Profile Picture Upload
        if ($_FILES['picture']['name'] !== "") {
            $uploaddir = 'profile_pics/';
            $path_parts = pathinfo($_FILES["picture"]["name"])['extension'];
            $uploadfile = $uploaddir . $this->newUser['username'] . '.' . $path_parts;
            if($_FILES['picture']['error'] === 0) {
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile))
                    $this->newUser['profile_picture'] = $uploadfile;
                else
                    echo "Something wrong with file/directory!!";
            }
        }

        if ($isValid) {
            Session::set('register', $this->newUser);
            header('Location: ' . URL . 'register/page/3');
        } else {
            $this->view->title = 'ERROR - User information';
            $this->view->genders = $this->model->getGenders();
            $this->view->render('register/userInfo');
        }
        return true;
    }

    /**
     * @return bool
     */
    public function doAddressInfo()
    {
        if (!isset($_POST['submitAddress'])) {
            header('Location: ' . URL . 'register/page/3');
            return true;
        }

        $isValid = true;

        if (preg_match('/^([+\-().]|\d){8,}$/', $_POST['phone']) === 1)
            $this->newUser['phone'] = $_POST['phone'];
        else {
            $this->view->phoneError = 'Phone number is not valid';
            $isValid = false;
        }

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

        //Server-side check if Country conforms
        if ($this->model->validateCountry($_POST['country']))
            $this->newUser['country'] = $_POST['country'];
        else {
            $this->view->countryError = 'Country value given does not exist.';
            $isValid = false;
        }

        if (preg_match('/(^\d{5}(-\d{4})?$)|(^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$)/',
                $_POST['postalcode']) === 1
        )
            $this->newUser['postalcode'] = $_POST['postalcode'];
        else {
            $this->view->codeError = 'Postal/Zip code does not conform.';
            $isValid = false;
        }

        if ($isValid) {
            Session::set('register', $this->newUser);
            header('Location: ' . URL . 'register/page/4');
        } else {
            $this->view->title = 'ERROR - Profile information';
            $this->view->countries = $this->model->getCountries();
            $this->view->render('register/addressInfo');
        }
        return true;
    }

    public static function isEmpty($string)
    {
        return strcmp('', $string) == 0;
    }

    public function doUpdateUser()
    {
        //AuthInfo Validation

        echo print_r($_POST);

        $this->newUser = $_SESSION['my_user'];


        $isValid = true;
        if (!self::isEmpty($_POST['username'])) {
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
        }

//changes the profile picture
        if ($_FILES['picture']['name'] !== "") {
            $uploaddir = 'user_images/';
            $path_parts = pathinfo($_FILES["picture"]["name"])['extension'];
            $uploadfile = $uploaddir . $this->newUser['username'] . '.' . $path_parts;

            if($_FILES['picture']['error'] === 0) {
                $this->newUser['profile_picture'] = ((isset($uploadfile) && move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) ? $uploadfile : null);
            }
            else{
                $isValid = false;
                $this->view->profileImageError = 'Image is too large...Or we just don\'t like it.';
            }
        }


        if (!self::isEmpty($_POST['password'])) {
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
        }

        if (!self::isEmpty($_POST['email'])) {
            if (preg_match('/^\S+@\S+\.\S+$/', $_POST['email']) === 1)
                if ($this->model->validateEmail($_POST['email']))
                    $this->newUser['email'] = $_POST['email'];
                else {
                    $this->view->emailError = 'The email is already being used';
                    $isValid = false;
                }
            else {
                $this->view->emailError = 'The email is not valid';
                $isValid = false;
            }
        }

        //Next Auth info

        //ServerSide check if first name conforms
        if (!self::isEmpty($_POST['first_name'])) {
            if (preg_match('/^([A-z]){2,20}$/', $_POST['first_name']) === 1)
                $this->newUser['first_name'] = $_POST['first_name'];
            else {
                $this->view->firstNameError = 'Your name cannot contain numbers and must be'
                    . 'between 2 and 20 characters';
                $isValid = false;
            }
        }

        //ServerSide check if last name conforms
        if (!self::isEmpty($_POST['last_name'])) {
            if (preg_match('/^([A-z]){2,20}$/', $_POST['last_name']) === 1)
                $this->newUser['last_name'] = $_POST['last_name'];
            else {
                $this->view->lastNameError = 'Your name cannot contain numbers and must be'
                    . 'between 2 and 20 characters';
                $isValid = false;
            }
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
        if (preg_match('/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/', $_POST['date_of_birth']) === 1
            && (int)date_diff($date_birthDate, $date_today)->format('%r%y') >= 13
        )
            $this->newUser['date_of_birth'] = $_POST['date_of_birth'];
        else {
            $this->view->dobError = 'You must be 13 years or older to join';
            $isValid = false;
        }

        // Last validation

        if (!self::isEmpty($_POST['phone'])) {
            if (preg_match('/^([+\-().]|\d){8,}$/', $_POST['phone']) === 1)
                $this->newUser['phone'] = $_POST['phone'];
            else {
                $this->view->phoneError = 'Phone number is not valid';
                $isValid = false;
            }
        }

        //Server-Side check if address conforms
        if (!self::isEmpty($_POST['address'])) {
            if (preg_match('/^.{4,20}$/', $_POST['address']) === 1)
                $this->newUser['address'] = $_POST['address'];
            else {
                $this->view->addressError = 'Address must be between 4 and 20 characters.';
                $isValid = false;
            }
        }

        //Server-Side check if city conforms
        if (!self::isEmpty($_POST['city'])) {
            if (preg_match('/^.{4,20}$/', $_POST['city']) === 1)
                $this->newUser['city'] = $_POST['city'];
            else {
                $this->view->cityError = 'City must be between 4 and 20 characters.';
                $isValid = false;
            }
        }

        //Server-side check if Province conforms
        if (!self::isEmpty($_POST['province'])) {
            if (preg_match('/^.{4,20}$/', $_POST['province']) === 1)
                $this->newUser['province'] = $_POST['province'];
            else {
                $this->view->provinceError = 'Address must be between 4 and 20 characters.';
                $isValid = false;
            }
        }

        //Server-side check if Country conforms
        if ($this->model->validateCountry($_POST['country']))
            $this->newUser['country'] = $_POST['country'];
        else {
            $this->view->countryError = 'Country value given does not exist.';
            $isValid = false;
        }

        if (!self::isEmpty($_POST['postalcode'])) {
            if (preg_match('/(^\d{5}(-\d{4})?$)|(^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$)/',
                    $_POST['postalcode']) === 1
            )
                $this->newUser['postalcode'] = $_POST['postalcode'];
            else {
                $this->view->codeError = 'Postal/Zip code does not conform.';
                $isValid = false;
            }
        }

        $uid = Session::get('my_user')['id'];
        $res = $this->model->updateUser($this->newUser, $uid);
        echo print_r($this->newUser);
        if ($isValid && $res) {
            $_SESSION['my_user'] = $this->newUser;
            header('Location: ' . URL . 'wall');
        } else {

            $this->view->title = 'ERROR - Login information';
            $this->view->user = $_SESSION['my_user'];
            $this->view->countries = $this->model->getCountries();
            $this->view->genders = $this->model->getGenders();
            $this->view->render('wall/edit');
            echo print_r($this->model->getError());
        }
    }
}