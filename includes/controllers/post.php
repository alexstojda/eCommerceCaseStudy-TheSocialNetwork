<?php

class Post extends Controller
{

    public function __construct()
    {
        parent::__construct();
        Session::checkMember();
    }

    public function index()
    { //TODO Implement privacy
        if (isset($_GET['id'])) {
            $this->view->post = $this->getModel('Post', $_GET['id']);
            $this->view->render('post/index');
        } else {
            header('Location: ../home');
        }
    }


    public function getPosts()
    {
        //This is where all the posts come form...it's pretty fucking savage
    }

    public function getFriends()
    {
        //As sad as this method is named. It will be used to populate the table of friends on the side of the page.
        //may want to make this link to other pages as well
    }

}