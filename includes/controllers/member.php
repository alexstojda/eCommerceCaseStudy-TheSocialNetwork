<?php

class Member extends Controller
{

    public function index()
    {
        self::checkMember();
        $this->view->title = 'Member';
        $this->view->render('member/index');
    }

}