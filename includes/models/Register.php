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

    public function getGenders()
    {
        return $this->db->select('SELECT * FROM gender');
    }

    public function getCountry($id)
    {
        return $this->db->select('SELECT country_name FROM countries WHERE country_ISO_ID = :id', array(':id' => $id))[0]['country_name'];
    }

    public function getGender($id)
    {
        return $this->db->select('SELECT gender_desc FROM gender WHERE gender_id = :id', array(':id' => $id))[0]['gender_desc'];
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
}