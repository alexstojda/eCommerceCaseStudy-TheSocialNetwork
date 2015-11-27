<?php

/**
 * Class member
 * Authentication test
 *
 */
class member extends Controller
{

    public function index()
    {
        self::checkMember();
        $this->view->title = 'Member';
        $this->view->render('member/index');
    }

}