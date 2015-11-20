<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-19
 * Time: 5:09 PM
 */
class inbox extends Controller
{

    /**
     * inbox constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->title = 'Inbox';
        $this->view->render('inbox/index');
    }
}