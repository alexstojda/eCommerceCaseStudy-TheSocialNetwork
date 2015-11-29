<?php

/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/25/2015
 * Time: 10:51 PM
 */
class _Search extends Model
{
    private $foundUsers;
    private $foundGroups;

    /**
     * _Search constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed|null return list of users if any are found linked to the string
     */
    public function searchUsers()
    {
        $st = $this->db->select('SELECT *, CONCAT(first_name, \' \' , last_name) FROM `users` WHERE first_name LIKE :search OR last_name LIKE :search OR phone LIKE :search OR email LIKE :search OR  CONCAT(first_name, \' \' , last_name) LIKE :search ',
            [':search' => "%" . $_GET['search'] . "%"]);

        if (count($st) > 0) {
            return $st;
        } else
            return null;
    }
    /**
     * @return mixed|null return list of groups if any are found linked to the string
     */
    public function searchGroups()
    {
        $st = $this->db->select('SELECT * FROM `groups` WHERE name LIKE :search',
            [':search' => "%" . $_GET['search'] . "%"]);

        if (count($st) > 0) {
            return $st;
        } else
            return null;
    }


    public function getFoundUsers()
    {
        return $this->foundUsers;
    }

    public function getFoundGroups()
    {
        return $this->foundGroups;
    }

    public function setFoundUsers($array)
    {
        $this->foundUsers = $array;
    }

    public function setFoundGroups($array)
    {
        $this->foundGroups = $array;
    }
}