<?php

class Member extends Controller
{

    function index()
    {
        Session::checkMember();
        $this->view->title = 'Member';
        $this->view->render('member/index');
    }

}