<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-16
 * Time: 7:45 AM
 */
class _Register extends Model
{

    /**
     * _Register constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getCountries()
    {
        return $this->db->select("SELECT * FROM countries");
    }

    public function getGenders() {
        return $this->db->select('SELECT * FROM gender');
    }

    public function validateUsername($username)
    {
        $res = $this->db->select('SELECT user_id FROM users WHERE username = :username',
            array(':username' => $username));
        if (count($res) > 0)
            return false;
        else {
            return true;
        }
    }

    public function validateCountry($ISOid) {
        $res = $this->db->select('SELECT country_ISO_ID FROM countries WHERE country_ISO_ID = :id',
            array(':id' => $ISOid));
        if (count($res) == 1)
            return true;
        else {
            return false;
        }
    }

    public function validateGender($genderID) {
        $res = $this->db->select('SELECT gender_id FROM gender WHERE gender_id = :id',
            array(':id' => $genderID));
        if (count($res) == 1)
            return true;
        else {
            return false;
        }
    }
}