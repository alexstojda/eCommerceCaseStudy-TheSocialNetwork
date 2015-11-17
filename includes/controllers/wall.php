<?php

class Wall extends Controller {

    function __construct() {
        parent::__construct();
        Session::checkMember();
    }

    function index() {

        if(isset($_GET['u'])){
            $uid = $_GET['u'];
        }
        else{

            if(Session::get('my_user'))
                header("Location: ../wall?u=". Session::get('my_user')['id']);
            else
                header("Location: ../home");
        }
        //THIS FUCKING WORKS
        $this->view->title = 'Wall';
        $this->wall = $this->getModel('Wall');
        $this->wall->wallUser = $this->getModel('User',$uid);
        $this->post = $this->getModel('Post');
        $this->wall->init($uid);
        $this->view->name = $this->wall->getName();

        $this->view->render('wall/index');
    }


}