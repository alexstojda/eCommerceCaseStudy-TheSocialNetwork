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
    private $privacy;

//andrew did $this...i don't understand it. -Evan
    //"Constructor makes generic if not logged in" -Evan
    public function __construct($tempID = 0)
    {
        parent::__construct();
        switch ($tempID) {
            case 0 :
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
                $this->privacy = 'none';
                break;
            case ($tempID === Session::get('id')) :
                //$this->db = Database::noParam();
                $st = $this->db->select('SELECT * FROM users WHERE user_id = :uid', array(
                    ':uid' => $tempID,
                ))[0];
                $this->init_self($st);
                break;
            default :
                $st = $this->db->select('SELECT * FROM users WHERE user_id = :uid', array(
                    ':uid' => $tempID,
                ))[0];
                init_generic($st);
                break;

        }
    }

    //Save user info in session
    public function store()
    {
        Session::set('my_user', [
            'id' => $this->getUserID(),
            'user' => $this->getUsername(),
            //'pass'      => $this->getID(),
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
            'privacy' => $this->getPrivacy()
        ]);
    }

    //................. did you get it yet..... okay bye...
    public function authenticate()
    {
        $st = $this->db->select('SELECT * FROM users WHERE username = :username AND password = :pass', array(
            ':username' => $_POST['inputUser'],
            ':pass' => Hash::create('sha256', $_POST['inputPassword'], HASH_PW_KEY)
        ))[0];
        //$this->db = null;
        if (count($st) > 0) {
            $this->init_self($st);
            //THIS LOOKS RETARDED, BUT TRUST.
            Session::set('Status', count($st));
            Session::set('id', $st['user_id']);

        if(count($st) > 0) {
			Session::init();
			Session::set('loggedIn', true);
        }
        return false;
    }

//LOOK AT THE GETTERS
    public function getID()
    {
        return $this->userID;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFname()
    {
        return $this->fname;
    }

    public function getLname()
    {
        return $this->lname;
    }

    public function getName()
    {
        return $this->fname . ' ' . $this->lname;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getProvince()
    {
        return $this->province;
    }

    public function getPostalcode()
    {
        return $this->postalcode;
    }

    public function getBirth()
    {
        return $this->birth;
    }

    public function getPrivacy()
    {
        return $this->privacy;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getCountry()
    {
        return $this->country;
    }

    /////////////setters
    public function setPassword($newThing)
    {
        $this->u_password = $newThing;
    }

    public function setEmail($newThings)
    {
        $this->email = $newThings;
    }

    public function setFname($newThings)
    {
        $this->fname = $newThings;
    }

    public function setLname($newThings)
    {
        $this->lname = $newThings;
    }

    public function setPhone($newThings)
    {
        $this->phone = $newThings;
    }

    public function setAddress($newThings)
    {
        $this->address = $newThings;
    }

    public function setCity($newThings)
    {
        $this->city = $newThings;
    }

    public function setProvince($newThings)
    {
        $this->province = $newThings;
    }

    public function setPostalcode($newThings)
    {
        $this->postalcode = $newThings;
    }

    public function setBirth($newThings)
    {
        $this->birth = $newThings;
    }

    public function setPrivacy($newThings)
    {
        $this->privacy = $newThings;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }
}

?>