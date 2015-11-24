<?php

class Model
{

    protected $db;

    function __construct()
    {
        $this->db = Database::noParam();
    }

    function getError()
    {
        return $this->db->errorInfo();
    }
}
