<?php

class _User extends Model
{
    private $userID;
    private $username;
    private $password;
    private $email;
    private $fname;
    private $lname;
    private $phone;
    private $address;
    private $city;
    private $country;
    private $province;
    private $postalcode;
    private $birth;
    private $picture;
    private $privacy;

    //"Constructor makes generic if not own wall" -Evan
    public function __construct($tempID = -1)
    {
        parent::__construct();
        switch ($tempID) {
            case -1 :
                $this->userID = 0;
                $this->username = 'guest';
                $this->password = 'nop';
                $this->email = 'nop';
                $this->fname = 'Guest';
                $this->lname = '';
                $this->phone = 'nop';
                $this->address = 'nop';
                $this->city = 'nop';
                $this->province = 'nop';
                $this->postalcode = 'nop';
                $this->birth = 'nop';
                $this->picture= 'http://www.gravatar.com/avatar/?d=mm&f=y';
                $this->privacy = 'none';
                break;
            case ($tempID === Session::get('my_user')['id']) : //load my wall.
                $st = $this->db->select('SELECT * FROM users WHERE user_id = :uid', array(
                    ':uid' => $tempID,
                ));
                if(count($st) > 0)
                    $this->init_self($st[0]);
                else //that user doesn't exist, give error and redirect to self
                    header('Location: ../wall?u=' . Session::get('my_user')['id']);
                break;
            default : //check if wall exists TODO Add access control based on friendship
                $st = $this->db->select('SELECT * FROM users WHERE user_id = :uid', array(
                    ':uid' => $tempID,
                ));
                if (count($st) > 0)
                    $this->init_generic($st[0]);
                else //that user doesn't exist, give error and redirect to self
                    header('Location: ../wall?u=' . Session::get('my_user')['id']);
                break;
        }
    }

    public function init_self($st)
    {

        $this->init_generic($st);
        $this->setPassword($st['password']);
        $this->store(); //STORE USER INFO IN SESSION ARRAY
    }

    public function init_generic($st)
    {
        $this->userID = $st['user_id'];
        $this->username = $st['username'];
        //self::setPassword($st['password']);
        self::setEmail($st['email']);
        self::setFName($st['first_name']);
        self::setLName($st['last_name']);
        self::setPhone($st['phone']);
        self::setAddress($st['address']);
        self::setCity($st['city']);
        self::setProvince($st['province']);
        self::setPostalCode($st['postalcode']);
        self::setBirth($st['date_of_birth']);
        self::setPicture($st['profile_picture']);
        self::setPrivacy($st['default_privacy']);
        self:: setCountry($st['country']);
    }

    public function store()
    {
        Session::set('my_user', [
            'id' => $this->getUserID(),
            'user' => $this->getUsername(),
            //'pass'      => $this->getPassword(),
            'email' => $this->getEmail(),
            'first_name' => $this->getFname(),
            'last_name' => $this->getLname(),
            'phone' => $this->getPhone(),
            'address' => $this->getAddress(),
            'city' => $this->getCity(),
            'country' => $this->getCountry(),
            'province' => $this->getProvince(),
            'postal' => $this->getPostalcode(),
            'birth' => $this->getBirth(),
            'picture' => $this->getPicture(),
            'privacy' => $this->getPrivacy()
        ]);
    }

    public function getUserID()
    {
        return $this->userID;
    }

//LOOK AT THE GETTERS

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($newThings)
    {
        $this->email = $newThings;
    }

    public function getFname()
    {
        return $this->fname;
    }

    public function setFName($newThings)
    {
        $this->fname = $newThings;
    }

    public function getLname()
    {
        return $this->lname;
    }

    public function setLName($newThings)
    {
        $this->lname = $newThings;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($newThings)
    {
        $this->phone = $newThings;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($newThings)
    {
        $this->address = $newThings;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($newThings)
    {
        $this->city = $newThings;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getProvince()
    {
        return $this->province;
    }

    /////////////setters

    public function setProvince($newThings)
    {
        $this->province = $newThings;
    }

    public function getPostalcode()
    {
        return $this->postalcode;
    }

    public function setPostalCode($newThings)
    {
        $this->postalcode = $newThings;
    }

    public function getBirth()
    {
        return $this->birth;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setBirth($newThings)
    {
        $this->birth = $newThings;
    }

    public function setPicture($newThings)
    {
        $this->picture = $newThings;
    }

    public function getPrivacy()
    {
        return $this->privacy;
    }

    public function setPrivacy($newThings)
    {
        $this->privacy = $newThings;
    }

    public function authenticate()
    {
        //Search db for user/password and get as array
        $st = $this->db->select('SELECT * FROM users WHERE username = :username AND password = :pass', array(
            ':username' => $_POST['inputUser'],
            ':pass' => Hash::create('sha256', $_POST['inputPassword'], HASH_PW_KEY)
        ))[0];

        if (count($st) > 0)  // if count is not 0, user & password was right
        {
            $this->init_self($st); //initialize from statement and store user info in session as array
            Session::set('id', $st['user_id']); //Set user's own id to session (if we want to switch from using user info array)
            return true;
        }
        return false;
    }

    public function getID()
    {
        return $this->userID;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($newThing)
    {
        $this->password = $newThing;
    }

    public function getName()
    {
        return $this->fname . ' ' . $this->lname;
    }
}