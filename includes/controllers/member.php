<?php

class Member extends Controller {

    function index() {

        $this->view->title = 'Member';
        $this->view->render('member/index');
    }

}