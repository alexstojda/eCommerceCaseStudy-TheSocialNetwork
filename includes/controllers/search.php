<?php

/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/25/2015
 * Time: 10:48 PM
 */
class search extends Controller
{
    public function index()
    {
        if (isset($_GET['search'])) {
            //TODO-andrew: Define functions

            $foundUsers =  $this->model->searchUsers();
            $foundGroups =  $this->model->searchGroups();

            $this->view->foundUsers = $foundUsers;
            $this->view->foundGroups = $foundGroups;

            $this->view->render('search/index');
        }
    }

}
