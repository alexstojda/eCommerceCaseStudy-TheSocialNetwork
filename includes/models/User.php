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
	public function __construct($tempID = 0) {
		$this->userID = $tempID;
		parent::__construct();
	}

	public function authenticate() {

        $st = $this->db->select('SELECT * FROM users WHERE username = :username AND password = :pass', array(
            ':username' => $_POST['inputUser'],
            ':pass' => Hash::create('sha256', $_POST['inputPassword'], HASH_PW_KEY)
        ));

        if(count($st) > 0) {
            echo " yes you exist";
            Session::init();
			Session::set('loggedIn', true);
        }
	}

//LOOK AT THE GETTERS

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