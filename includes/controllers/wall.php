<?php

class Wall extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index($userID = ' ') {
        //echo Hash::create('sha256', 'jesse', HASH_PASSWORD_KEY);
        //echo Hash::create('sha256', 'test2', HASH_PASSWORD_KEY);
        //$this->loadModel("Wall");
        //$this->model->setID($userID);
       
        $this->view->title = 'Wall';
        $this->view->render('wall/index');

    }
    public function page($page) {


    }
    function getPosts() {
    	//This is where all the posts come form...it's pretty fucking savage
    }
    function getFriends() {

    	//As sad as this method is named. It will be used to populate the table of friends on the side of the page. 
    	//may want to make this link to other pages as well
    }
    
}