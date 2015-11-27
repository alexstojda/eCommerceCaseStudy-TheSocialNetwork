<?php

class Model
{

    protected $db;

    public function __construct()
    {
        $this->db = Database::noParam();
    }

    public function getError()
    {
        return $this->db->errorInfo();
    }
}
