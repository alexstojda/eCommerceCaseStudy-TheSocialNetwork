<?php

class  Wall extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {

        if(isset($_GET['u'])){
          $uid = $_GET['u'];
        }
        else{
            
          if(isset($_Session['UserID']))
            header("Location: ../wall?u=". $_Session['UserID']);
          else
             header("Location: ../home");
        }

        $this->view->title = 'Wall';

        $this->wall = $this->loadModel('Wall');
        $this->post = $this->loadModel('Post');
        $this->wall->init($uid);
        $this->view->name = $this->wall->getName()['name'];
        $this->view->render('wall/index');


    }

}