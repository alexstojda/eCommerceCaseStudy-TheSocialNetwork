<?php

class Member extends Controller
{

    public function index()
    {
        Session::checkMember();
        $this->view->title = 'Member';
        $this->view->render('member/index');
    }

}