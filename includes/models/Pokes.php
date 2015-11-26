<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-21
 * Time: 9:32 PM
 */
class _Pokes extends Model
{

    /**
     * _Pokes constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getPokes()
    {
        //TODO: Get pokes sent to session user
    }

    public function sentPokes()
    {
        //TODO: Get pokes sent by session var
    }

    public function poke($uid)
    {
        return $this->db->insert('pokes', array('poked_by' => Session::get('my_user')['id'], 'poked' => $uid));
    }
}