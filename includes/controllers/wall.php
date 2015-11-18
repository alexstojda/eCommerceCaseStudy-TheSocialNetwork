<?php

/**
 * @property _wall wall
 */
class Wall extends Controller
{

    function __construct()
    {
        parent::__construct();
        Session::checkMember();
    }

    function index()
    {

        if (isset($_GET['u'])) {
            $uid = $_GET['u'];

            //SETUP AND INIT BASIC WALL
            $this->view->title = 'Wall';
            $this->wall = $this->getModel('Wall');
            $this->wall->wallUser = $this->getModel('User', $uid);
            $this->wall->init();
            $this->view->name = $this->wall->getName();

            //GET POSTS FROM MODEL
            foreach($this->wall->getUPosts() as $a_post) {
                $this->view->posts[] = $this->getModel('Post',$a_post['post_id']);
            }

            //FINALLY RENDER THE PAGE HTML
            $this->view->render('wall/index');
        } else {

            if (Session::get('my_user'))
                header("Location: ../wall?u=" . Session::get('my_user')['id']);
            else
                header("Location: ../home");
        }

    }


}