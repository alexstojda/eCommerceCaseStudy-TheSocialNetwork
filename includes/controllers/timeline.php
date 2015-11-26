<?php

/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/20/2015
 * Time: 1:12 PM
 */
class timeline extends postsContainer
{

    public function __construct()
    {
        parent::__construct();
        self::checkMember();
    }

    public function index()
    {
        $this->init(Session::get('my_user')['id']);
        $this->view->title = 'Your Timeline';
        $this->view->render('timeline/index');
    }
}
