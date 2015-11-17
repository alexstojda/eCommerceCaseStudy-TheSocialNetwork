<?php

class Post extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {

        //$this->loadModel("Wall");
        //$this->model->setID($userID);
       

        $this->view->render('post/index');
    }

    }
    function getPosts() {
    	//This is where all the posts come form...it's pretty fucking savage
    }

    function getFriends()
    {
        //As sad as this method is named. It will be used to populate the table of friends on the side of the page.
        //may want to make this link to other pages as well
    }
    
}