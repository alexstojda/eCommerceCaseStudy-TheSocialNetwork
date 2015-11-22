<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-21
 * Time: 9:15 PM
 */
class pokes extends Controller
{
    /**
     * @var _Pokes
     */
    protected $model;

    /**
     * pokes constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //TODO: load pokes sent and received

        //TODO: Send data to view
    }

    public function poke($uid) {
        echo $this->model->poke($uid);
        echo 'yay';
    }
}