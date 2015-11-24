<?php

/**
 * @property _Wall model
 *
 */
class Wall extends Controller
{

    public function __construct()
    {
        parent::__construct();
        self::checkMember();
        //ALL THE SESSION DEBUGS...
        Session::file_info();
        Session::dump();
    }

    public function index()
    {
        if (isset($_GET['u'])) {
            $uid = $_GET['u'];

            //SETUP AND INIT BASIC WALL

            //$this->loadModel('Wall');
            $this->model->init($this->getModel('User', $uid));
            $this->view->name = $this->model->getName();
            $this->view->id  = $uid;

            //GET POSTS FROM MODEL
            $this->view->posts_to_load = $this->model->getUPosts();
            /*if (!empty($this->model->getUPosts())) {
                foreach ($this->model->getUPosts() as $a_post) {
                    $this->view->posts[] = $this->getModel('Post', $a_post['post_id']);
                }
            }*/

            //FINALLY RENDER THE PAGE HTML
            $this->view->title = $this->model->getName() . '\'s Wall';
            $this->view->render('wall/index');
        } else {

            if (Session::get('my_user'))
                header("Location: ../wall?u=" . Session::get('my_user')['id']);
            else
                header("Location: ../home");
        }
    }
}