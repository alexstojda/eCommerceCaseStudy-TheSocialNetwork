<?php

/**
 * @property _Wall model
 *
 */
class Wall extends postsContainer
{

    public function __construct()
    {
        parent::__construct();
        self::checkMember();
    }

    public function index()
    {
        if (isset($_GET['u'])) {
            $uid = $_GET['u'];


            $this->init($uid);
            $this->view->name = $this->model->getName();
            $this->view->id  = $uid;
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