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
        Session::checkMember();
    }

    public function index()
    {
        if (isset($_GET['u'])) {
            $uid = $_GET['u'];

            //SETUP AND INIT BASIC WALL

            $this->loadModel('Wall');
            $this->model->setUser($this->getModel('User', $uid));
            $this->model->init();
            $this->view->name = $this->model->getName();

            //GET POSTS FROM MODEL
            foreach ($this->model->getUPosts() as $a_post) {
                $this->view->posts[] = $this->getModel('Post',$a_post['post_id']);
            }

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