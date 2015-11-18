<?php

/**
 * Class Model
 *
 * @property $db
 */
class Model
{

    protected $db;

    public function __construct()
    {
        $this->db = Database::noParam();
    }

}