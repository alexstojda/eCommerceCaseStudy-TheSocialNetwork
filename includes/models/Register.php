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

    /**
     * Gets a list of countries and associated data
     * @return array of country data from the Countries database table
     */
    public function getCountries()
    {
        return $this->db->select("SELECT * FROM countries");
    }

    /**
     * Returns and array of the recognized genders from the database
     * @return array Array of genders and their IDs
     */
    public function getGenders()
    {
        return $this->db->select('SELECT * FROM gender');
    }

    /**
     * Returns the name of the country with the given ID
     * @param $id int Country ID
     * @return string the country name
     */
    public function getCountry($id)
    {
        return $this->db->select('SELECT country_name FROM countries WHERE country_ISO_ID = :id', array(':id' => $id))[0]['country_name'];
    }

    /**
     * Gets the name of the given gender ID
     * @param $id int Gender ID
     * @return string the Name of the gender
     */
    public function getGender($id)
    {
        return $this->db->select('SELECT gender_desc FROM gender WHERE gender_id = :id', array(':id' => $id))[0]['gender_desc'];
    }

    /**
     * Verifies the given username isn't taken
     * @param $username string username to be validated
     * @return bool True if available, false otherwise
     */
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

    /**
     * Validates the country ID
     * @param $ISOid int Country ID to be validated
     * @return bool True if valid, false otherwise
     */
    public function validateCountry($ISOid)
    {
        $res = $this->db->select('SELECT country_ISO_ID FROM countries WHERE country_ISO_ID = :id',
            array(':id' => $ISOid));
        if (count($res) == 1)
            return true;
        else {
            return false;
        }
    }

    /**
     * Validates the genderID
     * @param $genderID int genderID
     * @return bool
     */
    public function validateGender($genderID)
    {
        $res = $this->db->select('SELECT gender_id FROM gender WHERE gender_id = :id',
            array(':id' => $genderID));
        if (count($res) == 1)
            return true;
        else {
            return false;
        }
    }

    public function validateEmail($email)
    {
        $res = $this->db->select('SELECT email FROM users WHERE email= :id',
            array(':id' => $email));
        if (count($res) > 0)
            return false;
        else {
            return true;
        }
    }

    public function insertUser($user)
    {
        $user['password'] = Hash::create('sha256', $user['password'], HASH_PW_KEY);
        return $this->db->insert('users', $user);
    }

    public function updateUser($user, $uid)
    {
        $user['password'] = Hash::create('sha256', $user['password'], HASH_PW_KEY);
        unset($user['id']);
        return $this->db->update('users', $user, "user_id = $uid");
    }

    public function deleteAccount($uid, $pass)
    {
        $pass = Hash::create('sha256', $pass, HASH_PW_KEY);
        return $this->db->delete('users', "`user_id` = $uid AND `password` = $pass");
    }
}