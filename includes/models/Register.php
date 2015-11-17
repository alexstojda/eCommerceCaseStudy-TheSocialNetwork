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
}