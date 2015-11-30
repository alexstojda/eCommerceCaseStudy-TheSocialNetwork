<?php

/**
 * Class Model
 * Base model class
 */
class Model
{

    protected $db;

    /**
     * Model constructor.
     * All models come with a db connection because is good to have....
     */
    public function __construct()
    {
        $this->db = Database::noParam();
    }

    /**
     * DB Testing purposes
     * @return array error array
     */
    public function getError()
    {
        return $this->db->errorInfo();
    }
}
