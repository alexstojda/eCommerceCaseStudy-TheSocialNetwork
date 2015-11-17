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

    public function getCountries() {
        return $this->db->select("SELECT * FROM countries");
    }
}